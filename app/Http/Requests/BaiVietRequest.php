<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validation cho bài viết
 * Validate: tên, slug, nội dung, ảnh bìa, trạng thái
 */
class BaiVietRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - Slug: unique (không trùng)
     * - Ảnh bìa: bắt buộc, image, max 2MB
     * - is_published, is_commented: nullable boolean
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string',
            'slug' => 'required|string|unique:bai_viets,slug',
            'noi_dung' => 'required|string',
            'anh_bia' => 'required|image||max:2048',
            'is_published' => 'nullable|boolean',
            'is_commented' => 'nullable|boolean',
        ];
    }
}
