<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Đảm bảo rằng yêu cầu được ủy quyền
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'email_nguoi_nhan' => 'required|email',
            'so_dien_thoai_nguoi_nhan' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'dia_chi_nguoi_nhan' => 'required|string|max:255',
            'ghi_chu' => 'nullable|string|max:1000',
            'tien_hang' => 'required|numeric',
            'tien_ship' => 'required|numeric',
            'tong_tien' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User ID là bắt buộc.',
            'user_id.exists' => 'User ID không tồn tại.',
            'email_nguoi_nhan.required' => 'Email người nhận là bắt buộc.',
            'email_nguoi_nhan.email' => 'Email người nhận không đúng định dạng.',
            'so_dien_thoai_nguoi_nhan.required' => 'Số điện thoại người nhận là bắt buộc.',
            'so_dien_thoai_nguoi_nhan.regex' => 'Số điện thoại người nhận không đúng định dạng.',
            'so_dien_thoai_nguoi_nhan.min' => 'Số điện thoại người nhận phải có ít nhất 10 ký tự.',
            'dia_chi_nguoi_nhan.required' => 'Địa chỉ người nhận là bắt buộc.',
            'dia_chi_nguoi_nhan.max' => 'Địa chỉ người nhận không được vượt quá 255 ký tự.',
            'ghi_chu.max' => 'Ghi chú không được vượt quá 1000 ký tự.',
            'tien_hang.required' => 'Tiền hàng là bắt buộc.',
            'tien_hang.numeric' => 'Tiền hàng phải là một số.',
            'tien_ship.required' => 'Tiền ship là bắt buộc.',
            'tien_ship.numeric' => 'Tiền ship phải là một số.',
            'tong_tien.required' => 'Tổng tiền là bắt buộc.',
            'tong_tien.numeric' => 'Tổng tiền phải là một số.',
        ];
    }
}

