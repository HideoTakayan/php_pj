<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller quản lý danh sách yêu thích (Wishlist)
 * Thêm/xóa sản phẩm yêu thích
 */
class WishlistController extends Controller
{
    // Danh sách sản phẩm yêu thích
    public function index()
    {
        $items = \App\Models\Wishlist::where('user_id', auth()->id())->get();
        return view('user.wishlist', compact('items'));
    }

    // Thêm sản phẩm vào wishlist (cần đăng nhập)
    public function add(Request $request)
    {
        if(auth()->check())
        {
            // firstOrCreate: tạo mới nếu chưa có, không tạo nếu đã có
            \App\Models\Wishlist::firstOrCreate([
                'user_id' => auth()->id(),
                'san_pham_id' => $request->id
            ]);
            return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào yêu thích!');
        }
        else
        {
            return redirect()->route('login');
        }
    }

    // Xóa sản phẩm khỏi wishlist
    public function remove($id)
    {
        \App\Models\Wishlist::where('user_id', auth()->id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi yêu thích!');
    }
}
