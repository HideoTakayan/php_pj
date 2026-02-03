<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = \App\Models\Slider::where('status', 1)->limit(3)->get();
        $danhmucs = DanhMuc::all();
        // Sản phẩm nổi bật: những sản phẩm được tích "hot" trong admin
        $featuredProducts = SanPham::query()->where('hot', 1)->take(8)->get();
        // Khuyến mãi hot: những sản phẩm có giá giảm
        $hotDeals = SanPham::query()->whereNotNull('gia_giam')->take(8)->get();
        // Banner khuyến mãi (lấy 2 sản phẩm đang giảm giá)
        $promoBanners = SanPham::query()->whereNotNull('gia_giam')->paginate(2);
        
        return view('includes.home', compact('sliders', 'danhmucs', 'featuredProducts', 'hotDeals', 'promoBanners'));
    }

    public function about()
    {
        return view('client.about');
    }

    public function contact()
    {
        return view('client.contact');
    }

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
