<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserPostRequest extends Request
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
            'name'=>'required',
            'password'=>'required',
            'phone'=>'required',
            'email'=>'required|regex:/\w+@\w+.["com","cn"]/'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'用户名必须填写',
            'password.required'=>'密码必须填写',
            'phone.required'=>'手机号必须填写',
            'email.required'=>'邮箱必须填写',
            'email.regex'=>'邮箱格式不正确'
        ];
    }
}
