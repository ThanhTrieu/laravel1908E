<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCategoryPost extends FormRequest
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
    public function rules(Request $request)
    {
        $id = $request->id;
        return [
            'nameCate' => 'required|max:100|unique:categories,name,'.$id
        ];
    }

    public function messages()
    {
        return [
            'nameCate.required' => 'Ten danh muc khong duoc trong',
            'nameCate.max' => 'Ten danh muc khong lon hon :max ky tu',
            'nameCate.unique' => 'Ten danh muc da ton tai, chon ten khac'
        ];
    }
}
