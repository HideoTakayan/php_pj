<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaiVietRequest extends FormRequest
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
            'ten' => 'required|string',
            'slug' => 'required|string|unique:bai_viets,slug',
            'noi_dung' => 'required|string',
            'anh_bia' => 'required|image||max:2048',
            'is_published' => 'nullable|boolean',
            'is_commented' => 'nullable|boolean',
        ];
    }
}
