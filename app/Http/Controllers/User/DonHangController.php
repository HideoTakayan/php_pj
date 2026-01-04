<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderConfirm;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\error;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cart = session()->get('cart', []);
        if (!empty($cart)) {
            $total = 0;
            $subTotal = 0;
            foreach ($cart as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }

            $shipping = 11;

            $total = $subTotal + $shipping;

            return view('user.orders.create', compact('cart', 'subTotal', 'total', 'shipping'));
        }
        return redirect()->route('cart.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {

        if ($request->isMethod('POST')) {
            DB::beginTransaction();

            try {
                $params = $request->except('_token');
                $params['ma_don_hang'] = $this->generateOrderCode();
                if (empty($params['ghi_chu'])) {
                    $params['ghi_chu'] = '';
                }



                $donHang = DonHang::query()->create($params);
                $donHangId = $donHang->id;

                $cart = session()->get('cart', []);

                foreach ($cart as $key => $value) {
                    $thanhTien = $value['gia'] * $value['so_luong'];

                    $donHang->chiTietDonHang()->create([
                        'don_hang_id' => $donHangId,
                        'san_pham_id' => $key,
                        'don_gia' => $value['gia'],
                        'so_luong' => $value['so_luong'],
                        'thanh_tien' => $thanhTien
                    ]);
                }

                DB::commit();

                try {
                    Mail::to($donHang->email_nguoi_nhan)->queue(new OrderConfirm($donHang));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
                }

                session()->put('cart', []);

                return redirect()->route('donhangs.index')->with('success', 'Đơn hàng đã được tạo thành công !!!');

            } catch (\Exception $e) {
                DB::rollBack();
                \Illuminate\Support\Facades\Log::error('Order creation failed: ' . $e->getMessage());
                return redirect()->route('cart.list')->with('error', 'Có lỗi khi tạo đơn hàng: ' . $e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateOrderCode() {
        do {
            $orderCode = 'ORD-' . Auth::id() . '-' . now()->timestamp;
        } while (DonHang::where('ma_don_hang', $orderCode)->exists());

        return $orderCode;
    }
}
