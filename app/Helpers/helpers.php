<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('check_image_url')) {
    function check_image_url($path)
    {
        if (Str::startsWith($path, 'http')) {
            return $path;
        }
        return Storage::url($path);
    }
}
