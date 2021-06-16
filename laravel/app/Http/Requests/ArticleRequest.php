<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'content' => 'required|string|max:500',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function attributes()
    {
        return [
            'content' => '本文',
            'tags' => 'タグ',
        ];
    }

    // バリデーション後の処理
    public function passedValidation()
    {
        // json変換・最大5個取得・各タグ名のみの配列作成
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function($requestTag) {
                return $requestTag->text;
            });

    }
}
