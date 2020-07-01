<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryPost extends FormRequest
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
            'nameCate' => 'required|max:100|unique:categories,name',
            'cateParent' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nameCate.required' => 'Ten danh muc khong duoc trong',
            'nameCate.max' => 'Ten danh muc ko lon hon :max ky tu',
            'nameCate.unique' => 'Ten danh muc da ton tai',
            'cateParent.required' => 'Hay chon Danh muc cha',
            'cateParent.numeric' => 'Gia tri luu tru cu danh muc la so'
        ];
    }
}
