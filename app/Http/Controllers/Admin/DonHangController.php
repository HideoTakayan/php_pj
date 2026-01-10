<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = DonHang::query()->orderByDesc('id')->paginate(10);
        return view('admin.orders.index', compact('donHangs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donHang = DonHang::with('chiTietDonHang.sanPham')->findOrFail($id);
        return view('admin.orders.show', compact('donHang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::findOrFail($id);
        $donHang->update([
            'trang_thai_don_hang' => $request->trang_thai_don_hang,
            'trang_thai_thanh_toan' => $request->trang_thai_thanh_toan
        ]);

        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function destroy($id)
    {
        // Tùy chọn: Xóa mềm hoặc xóa cứng
        // DonHang::destroy($id);
        // return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
    }
}
