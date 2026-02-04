<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validation cho tạo sản phẩm mới
 * Validate tất cả fields: tên, slug, mã SP, giá, ảnh, số lượng, danh mục
 */
class StoreSanPhamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - Slug & Mã SP: unique (không trùng)
     * - Giá giảm: nullable (có thể không có)
     * - Ảnh chi tiết: bắt buộc, array, mỗi ảnh max 2MB
     * - Danh mục: exists (phải tồn tại trong bảng danh_mucs)
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string|max:100',
            'slug' => 'required|string|max:100|unique:san_phams,slug',
            'ma_sp' => 'required|string|max:100|unique:san_phams,ma_sp',
            'mo_ta_ngan' => 'required|string|max:100',
            'mo_ta' => 'required|string',
            'gia' => 'required|numeric',
            'gia_giam' => 'nullable|numeric',
            'tinh_trang' => 'required|string',
            'hot' => 'nullable|boolean',
            'hinh_anh_chi_tiet' => 'required|array',
            'hinh_anh_chi_tiet.*' => 'image|max:2048', // Mỗi ảnh max 2MB
            'so_luong' => 'required|integer',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
        ];
    }
}
