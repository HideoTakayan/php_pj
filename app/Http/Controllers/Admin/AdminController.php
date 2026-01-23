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

        return view('admin.index', compact(
            'totalOrders', 'totalRevenue',
            'pendingOrders', 'pendingRevenue',
            'deliveredOrders', 'deliveredRevenue',
            'cancelledOrders', 'cancelledRevenue',
            'recentOrders'
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
