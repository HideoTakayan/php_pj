<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validation cho cập nhật sản phẩm
 * Tương tự Store nhưng:
 * - Slug & Mã SP: unique ngoại trừ sản phẩm hiện tại (ignore)
 * - Giá giảm: phải nhỏ hơn giá gốc (lt:gia)
 * - Ảnh chi tiết: nullable (không bắt buộc khi update)
 */
class UpdateSanPhamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - Rule::unique()->ignore(): cho phép giữ nguyên slug/mã của sản phẩm hiện tại
     * - gia_giam lt:gia: giá giảm phải nhỏ hơn giá gốc
     * - hinh_anh_chi_tiet: nullable (không bắt buộc phải upload lại ảnh)
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:100',
                Rule::unique('san_phams', 'slug')->ignore($this->san_pham) // Ignore sản phẩm hiện tại
            ],
            'ma_sp' => [
                'required',
                'string',
                'max:100',
                Rule::unique('san_phams', 'ma_sp')->ignore($this->san_pham)
            ],
            'mo_ta_ngan' => 'required|string|max:255',
            'mo_ta' => 'required|string',
            'gia' => 'required|numeric',
            'gia_giam' => 'nullable|numeric|lt:gia', // Giá giảm phải < giá gốc
            'tinh_trang' => 'required|string',
            'hot' => 'nullable|boolean',
            'hinh_anh_chi_tiet' => 'nullable|array', // Nullable khi update
            'hinh_anh_chi_tiet.*' => 'image|max:2048',
            'so_luong' => 'required|integer',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
        ];
    }
}
