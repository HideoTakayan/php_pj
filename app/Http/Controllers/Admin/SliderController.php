<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

/**
 * Controller quản lý slider (Admin)
 * CRUD slider trang chủ, upload ảnh, validation
 */
class SliderController extends Controller
{
    // Danh sách slider
    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    // Form tạo slider mới
    public function create()
    {
        return view('admin.sliders.create');
    }

    // Lưu slider mới (validation, upload ảnh)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $input['image'] = $request->file('image')->store('uploads/sliders', 'public');
        }

        Slider::create($input);

        return redirect()->route('admin.sliders.index')
                        ->with('success', 'Thêm Slider thành công.');
    }

    // Xem chi tiết slider
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    // Form sửa slider
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    // Cập nhật slider (xóa ảnh cũ, upload ảnh mới)
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required',
            'link' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $input['image'] = $request->file('image')->store('uploads/sliders', 'public');
        }

        $slider->update($input);

        return redirect()->route('admin.sliders.index')
                        ->with('success', 'Cập nhật Slider thành công');
    }

    // Xóa slider (xóa cả ảnh trong storage)
    public function destroy(Slider $slider)
    {
        if (Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('admin.sliders.index')
                        ->with('success', 'Xóa Slider thành công');
    }
}
