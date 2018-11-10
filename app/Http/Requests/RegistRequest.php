<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function messages()
    {
        return [
            'uname.required'=>'用户名不能为空',
            'uname.unique'=>'用户名已经存在',
           'mobile.required'=>'手机号码不能为空',
           'mobile.unique'=>'手机号已经存在',
           'mobile.regex'=>'手机号码格式不正确',
           'password.required'=>'密码不能为空',
           'password.between'=>'密码为6-18位数',
           'password.confirmed'=>'密码不一致',
           'protocol.accepted' => '请同意协议',
           'code.required'=>'验证码不能为空',
           'code.between'=>'验证码为6位数',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          
           'protocol'=>'accepted',
           'uname'=>'required|unique:users,uname',
           'mobile'=>[
               'required',
               'regex:/^((13[0-9])|(14[5|7])|(15([0-3]|[5-9]))|(18[0,5-9]))\\d{8}$/',
               'unique:users,mobile', 
           ],
           'password'=>'required|between:6,18|confirmed',
           'code'=>'required|between:6,6',

        ];
    }
}
