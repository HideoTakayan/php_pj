<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listCart()
    {
        // session()->put('cart', []);
        $cart = session()->get('cart', []);



        $total = 0;
        $subTotal = 0;

        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }

        // $ship_fee = $subTotal * 0.01;
        $ship_fee = 11;

        $total = $subTotal + $ship_fee;

        return view('user.carts.index', compact('cart', 'subTotal', 'ship_fee', 'total',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');


        $sanPham = SanPham::findOrFail($productId);

        // khởi tạo 1 mảng chưa cart info trên session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['so_luong'] += $quantity;
        } else {
            $cart[$productId] = [
                'ten' => $sanPham->ten,
                'so_luong' => $quantity,
                // 'gia' => isset($sanPham->gia_giam) ? $sanPham->gia_giam : $sanPham->gia,
                'gia' => $sanPham->finalPrice(),
                'hinh_anh' => $sanPham->hinh_anh,
                'slug' => $sanPham->slug,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }

    public function updateCart(Request $request) {
        $cartNew = $request->input('cart', []);

        session()->put('cart', $cartNew);

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
    }
}
