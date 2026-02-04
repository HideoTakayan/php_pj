<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * Helper function: Kiểm tra và trả về URL ảnh đúng
 * 
 * Nếu path bắt đầu bằng 'http' → trả về nguyên (URL external)
 * Nếu không → tạo URL từ Storage (uploads/...)
 * 
 * Sử dụng: check_image_url($sanPham->hinh_anh)
 */
if (!function_exists('check_image_url')) {
    function check_image_url($path)
    {
        if (Str::startsWith($path, 'http')) {
            return $path; // URL external (http://example.com/image.jpg)
        }
        return Storage::url($path); // URL local (/storage/uploads/...)
    }
}
