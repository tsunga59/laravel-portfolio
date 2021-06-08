<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users',
            // 'profile_image' => 'string',
            // 'self_introduction' => 'string|max:300',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|max:255|min:8|regex:/^[a-zA-Z0-9]+$/',
        ];
    }

    /**
     * 定義済みバリデーションルールのエラーメッセージ取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => '指定された:attributeは既に使われています。',
            'password.regex' => ':attributeは半角英数字で入力してください。',
        ];
    }
}