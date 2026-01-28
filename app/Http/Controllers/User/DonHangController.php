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


class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $query = DonHang::where('user_id', Auth::id())->orderBy('created_at', 'desc');

        if ($status) {
            if ($status == 'cho_xac_nhan') {
                $query->where('trang_thai_don_hang', DonHang::CHO_XAC_NHAN);
            } elseif ($status == 'dang_giao') {
                $query->whereIn('trang_thai_don_hang', [
                    DonHang::DA_XAC_NHAN, 
                    DonHang::DANG_CHUAN_BI, 
                    DonHang::DANG_VAN_CHUYEN
                ]);
            } elseif ($status == 'da_giao') {
                $query->where('trang_thai_don_hang', DonHang::DA_GIAO_HANG);
            } elseif ($status == 'da_huy') {
                $query->where('trang_thai_don_hang', DonHang::HUY_DON_HANG);
            }
        }

        $orders = $query->paginate(10);
        return view('user.orders.index', compact('orders', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $cart = session()->get('cart', []);
        
        $selectedIds = $request->input('selected_products');
        
        // Handle persistent selection via session
        if ($selectedIds) {
            // If it's a string (from GET), convert to array
            if (is_string($selectedIds)) {
                $selectedIds = explode(',', $selectedIds);
            }
            session()->put('checkout_selected_products', $selectedIds);
        } else {
            $selectedIds = session()->get('checkout_selected_products');
        }
        
        if ($selectedIds && is_array($selectedIds) && count($selectedIds) > 0) {
             $cart = array_intersect_key($cart, array_flip($selectedIds));
        }

        if (!empty($cart)) {
            $total = 0;
            $subTotal = 0;
            foreach ($cart as $item) {
                $subTotal += $item['gia'] * $item['so_luong'];
            }

            $shipping = 36000;
            $discount = 0;
            $couponCode = '';

            // Check coupon session
            if (session()->has('coupon')) {
                $coupon = session()->get('coupon');
                $couponCode = $coupon['code'];
                if ($coupon['type'] == 'fixed') {
                    $discount = $coupon['value'];
                } else {
                    $discount = ($subTotal * $coupon['value']) / 100;
                }
            }

            $total = $subTotal + $shipping - $discount;
            if ($total < 0) $total = 0;

            return view('user.orders.create', compact('cart', 'subTotal', 'total', 'shipping', 'discount', 'couponCode', 'selectedIds'));
        }
        return redirect()->route('cart.list')->with('error', 'Giỏ hàng trống hoặc chưa chọn sản phẩm');
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

                // Recalculate Logic to be safe
                $cart = session()->get('cart', []);
                
                // Filter selected products
                $selectedIds = $request->input('selected_products');
                if ($selectedIds && is_string($selectedIds)) { // If passed as string
                     $selectedIds = explode(',', $selectedIds);
                }
                
                if ($selectedIds && is_array($selectedIds) && count($selectedIds) > 0) {
                     $cart = array_intersect_key($cart, array_flip($selectedIds));
                }

                if (empty($cart)) {
                     return redirect()->route('cart.list')->with('error', 'Không có sản phẩm nào để thanh toán');
                }

                $subTotal = 0;
                foreach ($cart as $item) {
                    $subTotal += $item['gia'] * $item['so_luong'];
                }
                $shipping = 36000;
                $discount = 0;

                if (session()->has('coupon')) {
                    $coupon = session()->get('coupon');
                    if ($coupon['type'] == 'fixed') {
                        $discount = $coupon['value'];
                    } else {
                        $discount = ($subTotal * $coupon['value']) / 100;
                    }
                }

                $params['tien_hang'] = $subTotal;
                $params['tien_ship'] = $shipping;
                $params['tien_giam_gia'] = $discount;
                $total = $subTotal + $shipping - $discount;
                if ($total < 0) $total = 0;
                $params['tong_tien'] = $total;

                $donHang = DonHang::query()->create($params);
                $donHangId = $donHang->id;

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

                // Remove ONLY bought items
                $fullCart = session()->get('cart', []);
                foreach ($cart as $key => $val) {
                    unset($fullCart[$key]);
                }
                session()->put('cart', $fullCart);
                
                // Clear coupon if cart is empty or optional logic
                session()->forget('coupon');

                return redirect()->route('home.index')->with('success', 'Đơn hàng đã được tạo thành công !!!');

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
    public function show($id)
    {
        $order = DonHang::with('chiTietDonHang.sanPham')->where('user_id', Auth::id())->findOrFail($id);
        return view('user.orders.show', compact('order'));
    }

    public function reorder($id) {
        $order = DonHang::with('chiTietDonHang.sanPham')->where('user_id', Auth::id())->findOrFail($id);
        
        $cart = session()->get('cart', []);
        
        foreach ($order->chiTietDonHang as $detail) {
            $sp = $detail->sanPham;
            if ($sp) {
                // Add to cart with current product details
                $cart[$sp->id] = [
                    "ten" => $sp->ten,
                    "so_luong" => $detail->so_luong,
                    "gia" => $sp->gia_giam ?: $sp->gia,
                    "hinh_anh" => $sp->main_image,
                    "slug" => $sp->slug
                ];
            }
        }
        
        session()->put('cart', $cart);
        
        return redirect()->route('cart.list')->with('success', 'Đã thêm sản phẩm từ đơn hàng ' . $order->ma_don_hang . ' vào giỏ hàng.');
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

    public function applyCoupon(Request $request)
    {
        $code = $request->input('coupon_code');
        $coupon = \App\Models\Coupon::where('code', $code)->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại');
        }

        if ($coupon->expiry_date && $coupon->expiry_date < now()) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn');
        }

        // Save to session
        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value
        ]);

        return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công');
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Đã gỡ mã giảm giá');
    }
}
