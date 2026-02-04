<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

/**
 * Controller quản lý mã giảm giá (Admin)
 * CRUD coupon, validation (code unique, expiry date)
 */
class CouponController extends Controller
{
    // Danh sách mã giảm giá
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    // Form tạo mã giảm giá
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Lưu mã giảm giá mới (validation: code unique, type, value, expiry_date)
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupons.index')->with('success', 'Mã giảm giá đã được tạo thành công.');
    }

    // Form sửa mã giảm giá
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    // Cập nhật mã giảm giá
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        $coupon->update($request->all());

        return redirect()->route('admin.coupons.index')->with('success', 'Mã giảm giá đã được cập nhật.');
    }

    // Xóa mã giảm giá
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Mã giảm giá đã được xóa.');
    }
}
