<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use Illuminate\Http\Request;

/**
 * Controller hiển thị bài viết (User)
 * Xem danh sách bài viết, chi tiết bài viết, tăng lượt xem
 */
class BaiVietController extends Controller
{
    // Danh sách bài viết (eager loading user, phân trang)
    public function index()
    {
        $baiViets = BaiViet::query()->with('user')->latest('id')->paginate(5);

        return view('user.posts.posts', compact('baiViets'));
    }

    // Chi tiết bài viết (tăng lượt xem)
    public function post_detail(string $slug)
    {
        $baiViet = BaiViet::with('user')->where('slug', $slug)->first();

        // Tăng lượt xem
        $baiViet->increment('luot_xem');

        return view('user.posts.detail', compact('baiViet'));
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

    public function destroy(string $id)
    {
        //
    }
}
