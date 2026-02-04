<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware kiểm tra quyền Admin
 * Chỉ cho phép user có utype = 'admin' truy cập
 * Nếu không phải admin → logout và redirect về login
 */
class AuthAdmin
{
    /**
     * Kiểm tra user có phải admin không
     * Logic:
     * 1. Nếu chưa đăng nhập → redirect login
     * 2. Nếu đã đăng nhập nhưng không phải admin → logout và redirect login
     * 3. Nếu là admin → cho phép tiếp tục
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->utype === 'admin') {
                return $next($request); // Cho phép truy cập
            } else {
                Session::flush(); // Logout user thường nếu cố truy cập admin
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
