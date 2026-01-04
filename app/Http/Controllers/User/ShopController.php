<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SanPham::query();

        // lọc theo danh mục
        if ($request->has('danh_muc_id')) {
            $query->where('danh_muc_id', $request->input('danh_muc_id'))->paginate(8);
        }

        $danhMucs = DanhMuc::all();
        $currentPage = $request->input('page', 1);
        $sanPhams = $query->latest('id')->paginate(8)->appends($request->except('page'));
        if ($currentPage > $sanPhams->lastPage() && $sanPhams->lastPage() > 0) {
            return redirect()->route('shop.index', array_merge($request->except('page'), ['page' => 1]));
        }

        return view('user.products.home', compact('danhMucs', 'sanPhams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function product_detail($slug)
    {
        $sanPham = SanPham::where('slug', $slug)->first();
        $relatedProducts = SanPham::where('danh_muc_id', $sanPham->danh_muc_id)
        ->where('slug', '!=', $slug)
        ->get();
        if ($relatedProducts->count() < 4) {
            $additionalProducts = SanPham::where('danh_muc_id', $sanPham->danh_muc_id)
                ->where('slug', '!=', $slug)
                ->whereNotIn('id', $relatedProducts->pluck('id'))
                ->take(4 - $relatedProducts->count())
                ->get();

            $relatedProducts = $relatedProducts->merge($additionalProducts);
        }

        $galleryImages = !empty($sanPham->hinh_anh_chi_tiet) ? array_filter(explode(',', $sanPham->hinh_anh_chi_tiet)) : [];


        return view('user.products.detail', compact('sanPham', 'galleryImages', 'relatedProducts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SanPham $sanPham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SanPham $sanPham)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SanPham $sanPham)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SanPham $sanPham)
    {
        //
    }
}
