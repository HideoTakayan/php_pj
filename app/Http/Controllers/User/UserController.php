<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller quản lý tài khoản user
 * Xem profile, cập nhật thông tin, đổi mật khẩu, upload avatar
 */
class UserController extends Controller
{
    // Trang dashboard user
    public function index(){
        $user = auth()->user();
        return view('user.index', compact('user'));
    }

    // Trang thông tin tài khoản
    public function profile() {
        $user = auth()->user();
        return view('user.account-details', compact('user'));
    }

    // Cập nhật thông tin tài khoản (tên, mật khẩu, avatar)
    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Đổi mật khẩu (kiểm tra mật khẩu cũ)
        if ($request->old_password) {
            if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu cũ không đúng']);
            }
            $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        }

        $user->name = $request->name;

        // Upload avatar mới (xóa avatar cũ)
        if ($request->hasFile('avatar')) {
             if ($user->avatar && file_exists(public_path('uploads/users/' . $user->avatar))) {
                unlink(public_path('uploads/users/' . $user->avatar));
            }

            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('uploads/users'), $imageName);
            $user->avatar = $imageName;
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
