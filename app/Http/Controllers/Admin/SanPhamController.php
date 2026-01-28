<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sanPhams = SanPham::query()
            ->with('danh_muc')
            ->when($search, function ($query, $search) {
                return $query->where('ten', 'like', "%{$search}%");
            })
            ->latest('id')->paginate(5);


        return view('admin.san_phams.index', compact('sanPhams', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhMucs = DanhMuc::all();
        return view('admin.san_phams.create', compact('danhMucs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSanPhamRequest $request)
    {
        $data = $request->except('hinh_anh_chi_tiet');

        if ($request->hasFile('hinh_anh_chi_tiet')) {
            $galleryImages = [];

            foreach ($request->file('hinh_anh_chi_tiet') as $file) {
                $imageName = $file->store('uploads/products', 'public');
                $galleryImages[] = $imageName;
            }
            
            // Lưu tất cả ảnh vào gallery
            $data['hinh_anh_chi_tiet'] = implode(',', $galleryImages);
        }

        SanPham::create($data);

        return redirect()->route('san_phams.index')->with('success', 'Tạo sản phẩm thành công.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SanPham $sanPham)
    {
        // $sanPham->with('danh_muc');
        return view('admin.san_phams.show', compact('sanPham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SanPham $sanPham)
    {
        $danhMucs = DanhMuc::all();
        return view('admin.san_phams.edit', compact('sanPham', 'danhMucs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSanPhamRequest $request, SanPham $sanPham)
    {
        $data = $request->except('hinh_anh_chi_tiet');

        if ($request->hasFile('hinh_anh_chi_tiet')) {
            // Xóa ảnh cũ
            $oldGalleryImages = explode(',', $sanPham->hinh_anh_chi_tiet);
            foreach ($oldGalleryImages as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }

            // Upload ảnh mới
            $newGalleryImages = [];
            foreach ($request->file('hinh_anh_chi_tiet') as $file) {
                $newGalleryImages[] = $file->store('uploads/products', 'public');
            }
            
            $data['hinh_anh_chi_tiet'] = implode(',', $newGalleryImages);
        }

        $sanPham->update($data);

        return back()->with('success', 'Cập nhật sản phẩm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SanPham $sanPham)
    {
        if (!empty($sanPham->hinh_anh_chi_tiet)) {
            $galleryImages = explode(',', $sanPham->hinh_anh_chi_tiet);

            foreach ($galleryImages as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $sanPham->delete();

        return back()->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
