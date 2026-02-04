<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validation cho địa chỉ giao hàng
 * Validate: họ tên, SĐT, địa chỉ, thành phố, quận, phường
 */
class DiaChiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - SĐT: numeric (chỉ chấp nhận số)
     * - Tất cả fields đều bắt buộc
     */
    public function rules(): array
    {
        return [
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|numeric',
            'dia_chi' => 'required|string',
            'thanh_pho' => 'required|string',
            'quan' => 'required|string',
            'phuong' => 'required|string'
        ];
    }
}
