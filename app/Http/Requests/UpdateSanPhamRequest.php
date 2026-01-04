<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSanPhamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:100',
                Rule::unique('san_phams', 'slug')->ignore($this->san_pham)
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
            'gia_giam' => 'nullable|numeric|lt:gia',
            'tinh_trang' => 'required|string',
            'hot' => 'nullable|boolean',
            'hinh_anh' => 'nullable|image|max:2048',
            // 'hinh_anh_chi_tiet' => 'nullable|image',
            'hinh_anh_chi_tiet.*' => 'nullable|image',
            'so_luong' => 'required|integer',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
        ];
    }
}
