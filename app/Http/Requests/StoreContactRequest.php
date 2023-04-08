<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:20',
            'title' => 'required|string|max:50',
            'email' => 'required|email|max:255', // unique:contact_forms (一意にしたい場合)
            'url' => 'url|nullable',
            'gender' => 'required|boolean',
            'age' => 'required',
            'contact' => 'required|max:200',
            'caution' => 'accepted',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'title' => '件名',
            'email' => 'メールアドレス',
            'url' => 'ホームページアドレス',
            'gender' => '性別',
            'age' => '年齢',
            'contact' => 'お問い合わせ内容',
            'caution' => '注意事項',
        ];
    }
}
