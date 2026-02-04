<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Http\Requests\StoreDanhMucRequest;
use App\Http\Requests\UpdateDanhMucRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Request;

/**
 * Controller quản lý danh mục (Admin)
 * CRUD danh mục, upload ảnh
 */
class DanhMucController extends Controller
{
    // Danh sách danh mục (có tìm kiếm, phân trang)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $danhMucs = DanhMuc::query()
            ->when($search, function ($query, $search) {
                return $query->where('ten', 'like', "%{$search}%");
            })
            ->latest('id')->paginate(5);

        return view('admin.danh_mucs.index', compact('danhMucs', 'search'));
    }

    // Form tạo danh mục mới
    public function create()
    {
        // $parentCategories = DanhMuc::whereNull('danh_muc_cha_id')->get();
        // return view('admin.danh_mucs.add', compact('parentCategories'));
        return view('admin.danh_mucs.add');
    }

    // Lưu danh mục mới (upload ảnh)
    public function store(StoreDanhMucRequest $request)
    {
        $data = $request->except('hinh_anh');

        if ($request->hasFile('hinh_anh')) {
            $data['hinh_anh'] = $request->file('hinh_anh')->store('uploads/danhmucs', 'public');
        }

        DanhMuc::create($data);

        return redirect()->route('danh_mucs.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    // Xem chi tiết danh mục
    public function show(DanhMuc $danhMuc)
    {
        return view('admin.danh_mucs.edit', compact('danhMuc'));
    }

    // Form sửa danh mục
    public function edit(DanhMuc $danhMuc)
    {
        return view('admin.danh_mucs.edit', compact('danhMuc'));
    }

    // Cập nhật danh mục (xóa ảnh cũ nếu upload ảnh mới)
    public function update(UpdateDanhMucRequest $request, DanhMuc $danhMuc)
    {
        $data = $request->except('hinh_anh');

        if ($request->hasFile('hinh_anh')) {
            $data['hinh_anh'] = $request->file('hinh_anh')->store('uploads/danhmucs', 'public');
        }

        $currentPath = $danhMuc->hinh_anh;

        if ($request->hasFile('hinh_anh') && Storage::disk('public')->exists($currentPath)) {
            Storage::disk('public')->delete($currentPath);
        }

        $danhMuc->update($data);

        return back()->with('success', 'Danh mục đã cập nhật thành công!');

    }

    // Xóa danh mục (xóa cả ảnh trong storage)
    public function destroy(DanhMuc $danhMuc)
    {
        if (Storage::disk('public')->exists($danhMuc->hinh_anh)) {
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }

        $danhMuc->delete();

        return back()->with('success', 'Danh mục xóa thành công!');
    }
}
