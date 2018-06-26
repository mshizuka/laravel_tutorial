<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            //
            'title' => 'required|unique:posts|min:3|max:30',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'title.required' => 'タイトルを入力してください',
            'title.unique' => 'このタイトルは既に使用されています',
            'title.min' => 'タイトルは３文字以上にしてください',
            'title.max' => 'タイトルは30文字以内にしてください',
            'content.required' => '本文を入力してください'
        ];
    }
}
