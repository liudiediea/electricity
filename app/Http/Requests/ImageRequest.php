<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'logo'=>'required | image | max:2048', 
        
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return  [
            'logo.required'=>'必须上传图片',
            'logo.image'=>'只能上传jpeg,png,bmp,gif,or svg格式图片',
            'logo.max'=>'图片最大不能超过2M',
        ];
    }

}
