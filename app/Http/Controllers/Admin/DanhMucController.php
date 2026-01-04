<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use App\Http\Requests\StoreDanhMucRequest;
use App\Http\Requests\UpdateDanhMucRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Request;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $parentCategories = DanhMuc::whereNull('danh_muc_cha_id')->get();
        // return view('admin.danh_mucs.add', compact('parentCategories'));
        return view('admin.danh_mucs.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDanhMucRequest $request)
    {
        $data = $request->except('hinh_anh');

        if ($request->hasFile('hinh_anh')) {
            $data['hinh_anh'] = $request->file('hinh_anh')->store('uploads/danhmucs', 'public');
        }

        DanhMuc::create($data);

        return redirect()->route('danh_mucs.index')->with('success', 'Danh mục đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DanhMuc $danhMuc)
    {
        return view('admin.danh_mucs.edit', compact('danhMuc'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhMuc $danhMuc)
    {
        return view('admin.danh_mucs.edit', compact('danhMuc'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhMuc $danhMuc)
    {
        if (Storage::disk('public')->exists($danhMuc->hinh_anh)) {
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }

        $danhMuc->delete();

        return back()->with('success', 'Danh mục xóa thành công!');
    }
}
