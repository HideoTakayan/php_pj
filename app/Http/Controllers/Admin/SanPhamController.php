<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Http\Requests\StoreSanPhamRequest;
use App\Http\Requests\UpdateSanPhamRequest;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller quản lý sản phẩm (Admin)
 * CRUD: Create, Read, Update, Delete
 * Xử lý upload nhiều ảnh (gallery)
 */
class SanPhamController extends Controller
{
    // Danh sách sản phẩm (có tìm kiếm, phân trang, eager loading)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sanPhams = SanPham::query()
            ->with('danh_muc') // Eager loading để tránh N+1 query
            ->when($search, function ($query, $search) {
                return $query->where('ten', 'like', "%{$search}%");
            })
            ->latest('id')->paginate(5);

        return view('admin.san_phams.index', compact('sanPhams', 'search'));
    }

    // Form tạo sản phẩm mới
    public function create()
    {
        $danhMucs = DanhMuc::all();
        return view('admin.san_phams.create', compact('danhMucs'));
    }

    // Lưu sản phẩm mới (upload nhiều ảnh)
    public function store(StoreSanPhamRequest $request)
    {
        $data = $request->except('hinh_anh_chi_tiet');

        // Upload nhiều ảnh (gallery)
        if ($request->hasFile('hinh_anh_chi_tiet')) {
            $galleryImages = [];

            foreach ($request->file('hinh_anh_chi_tiet') as $file) {
                $imageName = $file->store('uploads/products', 'public');
                $galleryImages[] = $imageName;
            }
            
            // Lưu dạng string phân cách bằng dấu phẩy
            $data['hinh_anh_chi_tiet'] = implode(',', $galleryImages);
        }

        SanPham::create($data);

        return redirect()->route('san_phams.index')->with('success', 'Tạo sản phẩm thành công.');
    }

    // Xem chi tiết sản phẩm
    public function show(SanPham $sanPham)
    {
        return view('admin.san_phams.show', compact('sanPham'));
    }

    // Form sửa sản phẩm
    public function edit(SanPham $sanPham)
    {
        $danhMucs = DanhMuc::all();
        return view('admin.san_phams.edit', compact('sanPham', 'danhMucs'));
    }

    // Cập nhật sản phẩm (xóa ảnh cũ, upload ảnh mới)
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

    // Xóa sản phẩm (xóa cả ảnh trong storage)
    public function destroy(SanPham $sanPham)
    {
        // Xóa tất cả ảnh trong gallery
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
