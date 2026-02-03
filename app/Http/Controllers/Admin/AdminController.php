<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DonHang;

class AdminController extends Controller
{
    public function index(){
        $totalOrders = DonHang::count();
        $totalRevenue = DonHang::sum('tong_tien');

        $pendingOrders = DonHang::where('trang_thai_don_hang', DonHang::CHO_XAC_NHAN)->count();
        $pendingRevenue = DonHang::where('trang_thai_don_hang', DonHang::CHO_XAC_NHAN)->sum('tong_tien');

        $deliveredOrders = DonHang::where('trang_thai_don_hang', DonHang::DA_GIAO_HANG)->count();
        $deliveredRevenue = DonHang::where('trang_thai_don_hang', DonHang::DA_GIAO_HANG)->sum('tong_tien');

        $cancelledOrders = DonHang::where('trang_thai_don_hang', DonHang::HUY_DON_HANG)->count();
        $cancelledRevenue = DonHang::where('trang_thai_don_hang', DonHang::HUY_DON_HANG)->sum('tong_tien');

        $recentOrders = DonHang::latest()->take(5)->get();

        // Monthly data for chart
        $monthlyData = DonHang::selectRaw('MONTH(created_at) as month, SUM(tong_tien) as revenue, COUNT(*) as orders,
            SUM(CASE WHEN trang_thai_don_hang = "cho_xac_nhan" THEN tong_tien ELSE 0 END) as pending,
            SUM(CASE WHEN trang_thai_don_hang = "da_giao_hang" THEN tong_tien ELSE 0 END) as delivered,
            SUM(CASE WHEN trang_thai_don_hang = "huy_don_hang" THEN tong_tien ELSE 0 END) as cancelled')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $monthlyRevenue = [];
        $monthlyOrders = [];
        $monthlyPendingArr = [];
        $monthlyDeliveredArr = [];
        $monthlyCancelledArr = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[] = $monthlyData->has($i) ? $monthlyData[$i]->revenue : 0;
            $monthlyOrders[] = $monthlyData->has($i) ? $monthlyData[$i]->orders : 0;
            $monthlyPendingArr[] = $monthlyData->has($i) ? $monthlyData[$i]->pending : 0;
            $monthlyDeliveredArr[] = $monthlyData->has($i) ? $monthlyData[$i]->delivered : 0;
            $monthlyCancelledArr[] = $monthlyData->has($i) ? $monthlyData[$i]->cancelled : 0;
        }

        // Rolling 30-day stats for growth
        $now = now();
        $startOfLast30Days = $now->copy()->subDays(30);
        $startOfPrev30Days = $now->copy()->subDays(60);

        $current30DaysRevenue = DonHang::where('created_at', '>=', $startOfLast30Days)->sum('tong_tien');
        $prev30DaysRevenue = DonHang::where('created_at', '>=', $startOfPrev30Days)
            ->where('created_at', '<', $startOfLast30Days)
            ->sum('tong_tien');
        $revenueGrowth = $prev30DaysRevenue > 0 ? (($current30DaysRevenue - $prev30DaysRevenue) / $prev30DaysRevenue) * 100 : ($current30DaysRevenue > 0 ? 100 : 0);

        $current30DaysOrders = DonHang::where('created_at', '>=', $startOfLast30Days)->count();
        $prev30DaysOrders = DonHang::where('created_at', '>=', $startOfPrev30Days)
            ->where('created_at', '<', $startOfLast30Days)
            ->count();
        $ordersGrowth = $prev30DaysOrders > 0 ? (($current30DaysOrders - $prev30DaysOrders) / $prev30DaysOrders) * 100 : ($current30DaysOrders > 0 ? 100 : 0);

        $yearRevenue = array_sum($monthlyRevenue);
        $yearOrders = array_sum($monthlyOrders);

        return view('admin.index', compact(
            'totalOrders', 'totalRevenue',
            'pendingOrders', 'pendingRevenue',
            'deliveredOrders', 'deliveredRevenue',
            'cancelledOrders', 'cancelledRevenue',
            'recentOrders',
            'monthlyRevenue', 'monthlyOrders', 'monthlyPendingArr', 'monthlyDeliveredArr', 'monthlyCancelledArr',
            'revenueGrowth', 'ordersGrowth',
            'yearRevenue', 'yearOrders'
        ));
    }

    public function profile() {
        return view('admin.profile');
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();

        if ($request->old_password) {
            if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng']);
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        }

        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists and not default
            if ($user->avatar && file_exists(public_path('uploads/users/' . $user->avatar))) {
                unlink(public_path('uploads/users/' . $user->avatar));
            }

            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/users'), $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
