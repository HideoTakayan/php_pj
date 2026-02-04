<?php

namespace App\Http\Requests;

use App\Models\DanhMuc;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

/**
 * Validation cho cập nhật danh mục
 * Tương tự Store nhưng unique ngoại trừ danh mục hiện tại
 */
class UpdateDanhMucRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - Rule::unique()->ignore(): cho phép giữ nguyên tên/slug của danh mục hiện tại
     * - Ảnh: nullable (không bắt buộc phải upload lại)
     */
    public function rules(): array
    {
        // Lấy ID danh mục từ route parameter
        $id = $this->route('danh_muc');

        return [
            'ten' => ['required','string','max:255', Rule::unique('danh_mucs', 'ten')->ignore($id)],
            'slug' => ['required','string','max:255', Rule::unique('danh_mucs', 'slug')->ignore($id)],
            'hinh_anh' => 'nullable|image|max:2048',
        ];
    }

    // Custom failed validation (đã comment - không sử dụng)
    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ], 422));
    // }
}
