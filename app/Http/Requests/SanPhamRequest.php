<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
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
        $id = $this->route('id'); // Lấy ID từ route (thường dùng trong trường hợp update)

        return [
            'ma_san_pham' => 'required|string|max:255|unique:san_phams,ma_san_pham,' . $id,
            'ten_san_pham' => 'required|string|max:255',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gia_san_pham' => 'required|numeric|min:0',
            'gia_khuyen_mai' => 'nullable|numeric|min:0|lt:gia_san_pham',
            'mo_ta_ngan' => 'nullable|string|max:1000',
            'so_luong' => 'required|integer|min:0',
            'ngay_nhap' => 'required|date',
            'danh_muc_id' => 'required|exists:danh_mucs,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'ma_san_pham.required' => 'Mã sản phẩm là bắt buộc.',
            'ma_san_pham.string' => 'Mã sản phẩm phải là chuỗi ký tự.',
            'ma_san_pham.max' => 'Mã sản phẩm không được vượt quá 255 ký tự.',
            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',

            'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
            'ten_san_pham.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'hinh_anh.image' => 'Hình ảnh phải là tệp hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'hinh_anh.max' => 'Hình ảnh không được vượt quá 2MB.',

            'gia_san_pham.required' => 'Giá sản phẩm là bắt buộc.',
            'gia_san_pham.numeric' => 'Giá sản phẩm phải là số.',
            'gia_san_pham.min' => 'Giá sản phẩm không được nhỏ hơn 0.',

            'gia_khuyen_mai.numeric' => 'Giá khuyến mãi phải là số.',
            'gia_khuyen_mai.min' => 'Giá khuyến mãi không được nhỏ hơn 0.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.',

            'mo_ta_ngan.string' => 'Mô tả ngắn phải là chuỗi ký tự.',
            'mo_ta_ngan.max' => 'Mô tả ngắn không được vượt quá 1000 ký tự.',

            'so_luong.required' => 'Số lượng là bắt buộc.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
            'so_luong.min' => 'Số lượng không được nhỏ hơn 0.',

            'ngay_nhap.required' => 'Ngày nhập là bắt buộc.',
            'ngay_nhap.date' => 'Ngày nhập phải là ngày hợp lệ.',

            'danh_muc_id.required' => 'Danh mục là bắt buộc.',
            'danh_muc_id.exists' => 'Danh mục không tồn tại.',
        ];
    }
}
