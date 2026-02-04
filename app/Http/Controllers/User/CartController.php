<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

/**
 * Controller xử lý giỏ hàng
 * Giỏ hàng lưu trong SESSION (không cần đăng nhập)
 */
class CartController extends Controller
{
    // Hiển thị trang giỏ hàng
    public function listCart()
    {
        $cart = session()->get('cart', []);

        $total = 0;
        $subTotal = 0;

        foreach ($cart as $item) {
            $subTotal += $item['gia'] * $item['so_luong'];
        }

        $ship_fee = 36000;
        $total = $subTotal + $ship_fee;

        return view('user.carts.index', compact('cart', 'subTotal', 'ship_fee', 'total',));
    }

    // Thêm sản phẩm vào giỏ hàng (nếu đã có thì tăng số lượng)
    public function addCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $sanPham = SanPham::findOrFail($productId);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Sản phẩm đã có → tăng số lượng
            $cart[$productId]['so_luong'] += $quantity;
        } else {
            // Sản phẩm chưa có → thêm mới
            $cart[$productId] = [
                'ten' => $sanPham->ten,
                'so_luong' => $quantity,
                'gia' => $sanPham->finalPrice(), // Ưu tiên giá giảm nếu có
                'hinh_anh' => $sanPham->main_image,
                'slug' => $sanPham->slug,
            ];
        }

        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }

    // Cập nhật số lượng sản phẩm trong giỏ
    public function updateCart(Request $request) {
        $cartNew = $request->input('cart', []);
        session()->put('cart', $cartNew);

        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeCart(Request $request) {
        $cart = session()->get('cart', []);
        $id = $request->input('cart_id');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        }

        return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }
}
