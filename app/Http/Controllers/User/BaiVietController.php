<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baiViets = BaiViet::query()->with('user')->latest('id')->paginate(5);

        return view('user.posts.posts', compact('baiViets'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function post_detail(string $slug)
    {
        $baiViet = BaiViet::with('user')->where('slug', $slug)->first();

        $baiViet->increment('luot_xem');

        return view('user.posts.detail', compact('baiViet'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
