<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller quản lý user (Admin)
 * Xem danh sách, xóa user (không cho xóa chính mình)
 */
class UserController extends Controller
{
    // Danh sách user
    public function index()
    {
        $users = \App\Models\User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    // Xóa user (không cho admin tự xóa chính mình)
    public function destroy(string $id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Ngăn admin tự xóa chính mình
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Bạn không thể tự xóa tài khoản của chính mình.');
        }

        $user->delete();

        return back()->with('success', 'Thành viên đã được xóa thành công.');
    }
}
