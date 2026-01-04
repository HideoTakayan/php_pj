<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaiVietRequest;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $baiViets = BaiViet::query()->with('user')->when($search, function ($query, $search) {
            return $query->where('ten', 'like', "%{$search}%");
        })->latest('id')->paginate(5);

        return view('admin.bai_viets.index', compact('baiViets', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bai_viets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BaiVietRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;

        if ($request->hasFile('anh_bia')) {
            $data['anh_bia'] = $request->file('anh_bia')->store('uploads/posts', 'public');
        }

        BaiViet::create($data);

        return redirect()->route('bai_viets.index')->with('success', 'Thêm mới bài viết thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(BaiViet $baiViet)
    {
        return view('admin.bai_viets.show', compact('baiViet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BaiViet $baiViet)
    {
        return view('admin.bai_viets.edit', compact('baiViet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BaiViet $baiViet)
    {
        $data = $request->except('_token');
        if ($request->hasFile('anh_bia')) {
            Storage::disk('public')->delete($baiViet->anh_bia);
            $data['anh_bia'] = $request->file('anh_bia')->store('upload/posts', 'public');
        }

        $baiViet->update($data);

        return redirect()->route('bai_viets.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BaiViet $baiViet)
    {
        if (Storage::disk('public')->exists($baiViet->anh_bia)) {
            Storage::disk('public')->delete($baiViet->anh_bia);
        }

        $baiViet->delete();

        return back()->with('success', 'Xoá bài viết thành công!');
    }
}
