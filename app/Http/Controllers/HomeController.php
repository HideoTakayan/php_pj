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
        $sanphams = SanPham::query()->paginate(8);
        $danhmucs = DanhMuc::all();
        $hots = SanPham::query()->where('hot', 1)->get();
        $sales = SanPham::query()->where('gia_giam', '<>', 'NULL')->paginate(2);
        return view('includes.home', compact('sanphams', 'danhmucs', 'hots', 'sales'));
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

        // Logic lưu liên hệ hoặc gửi mail có thể thêm ở đây
        // Ví dụ: LienHe::create($request->all());

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm nhất!');
    }
}
