<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

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

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

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

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Mã giảm giá đã được xóa.');
    }
}
