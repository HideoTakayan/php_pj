<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiaChiRequest;
use App\Models\DiaChi;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->id;
        $diaChis = DiaChi::where('user_id', $user)->with('user')->latest('id')->get();
        return view('user.address.index', compact('diaChis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.address.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiaChiRequest $request)
    {
        $data = $request->except('_token');
        $userId = auth()->user()->id;
        $data['user_id'] = $userId;



        DiaChi::create($data);

        return redirect()->route('address.index')->with('success', 'Thêm mới địa chỉ thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diaChi = DiaChi::findOrFail($id);
        return view('user.address.edit', compact('diaChi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiaChiRequest $request, string $id)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->user()->id;

        $diaChi = DiaChi::findOrFail($id);
        $diaChi->update($data);

        return redirect()->route('address.index')->with('success', 'Cập nhật địa chỉ thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diaChi = DiaChi::findOrFail($id);
        $diaChi->delete();

        return redirect()->route('address.index')->with('success', 'Xoá nhật địa chỉ thành công');

    }
}
