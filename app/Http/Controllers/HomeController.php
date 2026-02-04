<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

/**
 * Controller trang chủ
 * Hiển thị slider, sản phẩm nổi bật, khuyến mãi
 * Xử lý form liên hệ
 */
class HomeController extends Controller
{
    // Trang chủ: slider, sản phẩm nổi bật, khuyến mãi hot
    public function index()
    {
        $sliders = \App\Models\Slider::where('status', 1)->limit(3)->get();
        $danhmucs = DanhMuc::all();
        
        // Sản phẩm nổi bật: sản phẩm được tích "hot"
        $featuredProducts = SanPham::query()->where('hot', 1)->take(8)->get();
        
        // Khuyến mãi hot: sản phẩm có giá giảm
        $hotDeals = SanPham::query()->whereNotNull('gia_giam')->take(8)->get();
        
        // Banner khuyến mãi (2 sản phẩm đang giảm giá)
        $promoBanners = SanPham::query()->whereNotNull('gia_giam')->paginate(2);
        
        return view('includes.home', compact('sliders', 'danhmucs', 'featuredProducts', 'hotDeals', 'promoBanners'));
    }

    // Trang giới thiệu
    public function about()
    {
        return view('client.about');
    }

    // Trang liên hệ
    public function contact()
    {
        return view('client.contact');
    }

    // Xử lý form liên hệ (validation, lưu vào database)
    public function postContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'describe' => 'required'
        ]);

        \App\Models\LienHe::create($request->all());

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất!');
    }
}
