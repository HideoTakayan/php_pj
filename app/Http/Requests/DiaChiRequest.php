<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaChiRequest extends FormRequest
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
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|numeric',
            'dia_chi' => 'required|string',
            'thanh_pho' => 'required|string',
            'quan' => 'required|string',
            'phuong' => 'required|string'
        ];
    }
}
