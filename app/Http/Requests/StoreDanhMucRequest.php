<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Validation cho tạo danh mục mới
 * Validate: tên, slug, ảnh
 */
class StoreDanhMucRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - Tên & Slug: unique (không trùng)
     * - Ảnh: nullable (không bắt buộc), max 2MB
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string|max:255|unique:danh_mucs,ten',
            'slug' => 'required|string|unique:danh_mucs,slug',
            'hinh_anh' => 'nullable|image|max:2048',
        ];
    }

    // Custom failed validation (đã comment - không sử dụng)
    // Trả về JSON response khi validation fail (dùng cho API)
    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ]));
    // }
}
