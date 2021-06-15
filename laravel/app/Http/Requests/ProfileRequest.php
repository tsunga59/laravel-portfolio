<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users,name,'.Auth::user()->name.',name',
            'profile_image' => 'file',
            'self_introduction' => 'required|string|max:300',
            'wakeup_time' => 'required|date_format:H:i',
        ];
    }

    public function attributes()
    {
        return [
            'profile_image' => 'プロフィール画像',
            'self_introduction' => '自己紹介・意気込み',
            'wakeup_time' => '朝活目標時間',
        ];
    }

    public function messages()
    {
        return [
            'wakeup_time.date_format' => ':attributeを正しい形式で指定してください。',
        ];
    }
}
