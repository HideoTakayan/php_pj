<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDanhMucRequest;
use App\Http\Requests\UpdateDanhMucRequest;
use App\Models\DanhMuc;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiDanhMucController extends Controller
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

        return response()->json($danhMucs);
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

        // if ($request->fails()) {
        //     return response()->json([$request], 422);
        // }

        $danhMuc = DanhMuc::create($data);

        return response()->json([
            'message' => 'Danh mục đã được tạo thành công!',
            'data' => $danhMuc
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        return response()->json($danhMuc);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $danhMuc = DanhMuc::findOrFail($id);

        $data = $request->except('hinh_anh');

        if ($request->hasFile('hinh_anh')) {
            $data['hinh_anh'] = $request->file('hinh_anh')->store('uploads/danhmucs', 'public');
        }

        $currentPath = $danhMuc->hinh_anh;

        if ($request->hasFile('hinh_anh') && Storage::disk('public')->exists($currentPath)) {
            Storage::disk('public')->delete($currentPath);
        }

        $danhMuc->update($data);

        return response()->json([
            'message' => 'Danh mục đã cập nhật thành công!',
            'data' => $danhMuc
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $danhMuc = DanhMuc::findOrFail($id);

        if (Storage::disk('public')->exists($danhMuc->hinh_anh)) {
            Storage::disk('public')->delete($danhMuc->hinh_anh);
        }

        $danhMuc->delete();

        return response()->json([
            'message' => 'Danh mục xóa thành công!'
        ]);
    }
}
