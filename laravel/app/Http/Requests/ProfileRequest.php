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
        if(Auth::id() == config('user.guest_user_id')) {
            return [
                'self_introduction' => 'required|string|max:200',
                'wakeup_time' => 'required|date_format:H:i',
            ];
        } else {
            return [
                'name' => 'required|string|max:12|unique:users,name,'.Auth::user()->name.',name',
                'profile_image' => 'file|image|max:2048',
                'self_introduction' => 'required|string|max:200',
                'wakeup_time' => 'required|date_format:H:i',
            ];
        }
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
            'name.unique' => '指定された:attributeは既に使われています。',
            'wakeup_time.date_format' => ':attributeを正しい形式で指定してください。',
        ];
    }
}
