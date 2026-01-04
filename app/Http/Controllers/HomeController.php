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
}
