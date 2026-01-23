<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $items = \App\Models\Wishlist::where('user_id', auth()->id())->get();
        return view('user.wishlist', compact('items'));
    }

    public function add(Request $request)
    {
        if(auth()->check())
        {
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

    public function remove($id)
    {
        \App\Models\Wishlist::where('user_id', auth()->id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi yêu thích!');
    }
}
