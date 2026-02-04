<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiaChiRequest;
use App\Models\DiaChi;
use Illuminate\Http\Request;

/**
 * Controller quản lý địa chỉ user
 * CRUD địa chỉ giao hàng
 */
class AddressController extends Controller
{
    // Danh sách địa chỉ của user
    public function index()
    {
        $user = auth()->user()->id;
        $diaChis = DiaChi::where('user_id', $user)->with('user')->latest('id')->get();
        return view('user.address.index', compact('diaChis'));
    }

    // Form thêm địa chỉ mới
    public function create()
    {
        return view('user.address.add');
    }

    // Lưu địa chỉ mới
    public function store(DiaChiRequest $request)
    {
        $data = $request->except('_token');
        $userId = auth()->user()->id;
        $data['user_id'] = $userId;

        DiaChi::create($data);

        return redirect()->route('address.index')->with('success', 'Thêm mới địa chỉ thành công!');
    }

    public function show(string $id)
    {
        //
    }

    // Form sửa địa chỉ
    public function edit(string $id)
    {
        $diaChi = DiaChi::findOrFail($id);
        return view('user.address.edit', compact('diaChi'));
    }

    // Cập nhật địa chỉ
    public function update(DiaChiRequest $request, string $id)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;

        $diaChi = DiaChi::findOrFail($id);
        $diaChi->update($data);

        return redirect()->route('address.index')->with('success', 'Cập nhật địa chỉ thành công');
    }

    // Xóa địa chỉ
    public function destroy(string $id)
    {
        $diaChi = DiaChi::findOrFail($id);
        $diaChi->delete();

        return redirect()->route('address.index')->with('success', 'Xoá nhật địa chỉ thành công');

    }
}
