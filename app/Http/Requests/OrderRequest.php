<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validation cho đơn hàng (Checkout)
 * Validate thông tin người nhận: tên, email, SĐT, địa chỉ
 */
class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validation:
     * - Tên: bắt buộc, max 255 ký tự
     * - Email: bắt buộc, định dạng email
     * - SĐT: bắt buộc, max 15 ký tự, regex cho phép số, dấu cách, +, -, (, )
     * - Địa chỉ: bắt buộc, max 255 ký tự
     */
    public function rules(): array
    {
        return [
            'ten_nguoi_nhan' => 'required|string|max:255',
            'email_nguoi_nhan' => 'required|email|max:255',
            'sdt_nguoi_nhan' => 'required|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'dia_chi_nguoi_nhan' => 'required|string|max:255',
        ];
    }

    // Custom messages tiếng Việt
    public function messages()
    {
        return [
            'ten_nguoi_nhan.required' => 'Tên người nhận là bắt buộc.',
            'ten_nguoi_nhan.string' => 'Tên người nhận phải là một chuỗi ký tự.',
            'ten_nguoi_nhan.max' => 'Tên người nhận không được vượt quá 255 ký tự.',

            'email_nguoi_nhan.required' => 'Email người nhận là bắt buộc.',
            'email_nguoi_nhan.email' => 'Email người nhận phải là một địa chỉ email hợp lệ.',
            'email_nguoi_nhan.max' => 'Email người nhận không được vượt quá 255 ký tự.',

            'sdt_nguoi_nhan.required' => 'Số điện thoại người nhận là bắt buộc.',
            'sdt_nguoi_nhan.string' => 'Số điện thoại người nhận phải là một chuỗi ký tự.',
            'sdt_nguoi_nhan.max' => 'Số điện thoại người nhận không được vượt quá 15 ký tự.',
            'sdt_nguoi_nhan.regex' => 'Số điện thoại người nhận không hợp lệ.',

            'dia_chi_nguoi_nhan.required' => 'Địa chỉ người nhận là bắt buộc.',
            'dia_chi_nguoi_nhan.string' => 'Địa chỉ người nhận phải là một chuỗi ký tự.',
            'dia_chi_nguoi_nhan.max' => 'Địa chỉ người nhận không được vượt quá 255 ký tự.',
        ];
    }
}
