<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // xac thuc data
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|max:60',
            'password' => 'required|max:60'
        ];
    }

    // thong bao loi ra
    public function messages()
    {
        return [
            'username.required' => ' Username khong duoc trong',
            'username.max' => 'Username khong vuot qua :max ky tu',
            'password.required' => ' Password khong duoc trong',
            'password.max' => 'Password khong vuot qua :max ky tu',
        ];
    }
}
