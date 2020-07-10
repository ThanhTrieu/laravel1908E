<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducShoesPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nameProduct' => 'required|max:180',
            'priceProduct' => 'required',
            'qtyProduct' => 'required|numeric',
            'categoryProduct' => 'required|numeric',
            'brandProduct' => 'required|numeric',
            'colorProduct' => 'required',
            'sizeProduct' => 'required',
            'images' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nameProduct.required' => 'Ten san pham khong duoc trong',
            'nameProduct.max' => 'Ten san pham khong vuot qua :max ky tu',
            'priceProduct.required' => 'Gia san pham khong duoc trong',
            'qtyProduct.required' => 'So luong san pham khong duoc trong',
            'qtyProduct.numeric' => 'So luong san pham phai la so',
            'categoryProduct.required' => 'Hay chon danh muc san pham',
            'categoryProduct.numeric' => 'Id cua danh muc phai la so',
            'brandProduct.required' => 'Hay chon thuong hieu',
            'brandProduct.numeric' => 'Id cua thuong hieu phai la so',
            'colorProduct.required' => 'Hay chon mau sac',
            'sizeProduct.required' => 'Hay chon size san pham',
            'images.required' => 'Vui long nhap anh san pham'
        ];
    }
}
