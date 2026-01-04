<?php

namespace App\Http\Requests;

use App\Models\DanhMuc;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateDanhMucRequest extends FormRequest
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

        $id = $this->route('danh_muc');

        return [
            'ten' => ['required','string','max:255', Rule::unique('danh_mucs', 'ten')->ignore($id)],
            'slug' => ['required','string','max:255', Rule::unique('danh_mucs', 'slug')->ignore($id)],
            'hinh_anh' => 'nullable|image|max:2048',
            // 'danh_muc_cha_id' => 'nullable|exists:danh_mucs,id
        ];
    }

    // public function failedValidation(Validator $validator)

    // {

    //     throw new HttpResponseException(response()->json([

    //         'success'   => false,

    //         'message'   => 'Validation errors',

    //         'data'      => $validator->errors()

    //     ], 422));

    // }
}
