<?php
//phpcs:disable
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserRequest extends FormRequest
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
            'full_name' => 'string',
            'email' => 'string|unique:users',
            'password' => 'string',
            'permission_id' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => '名前をご記入ください',
            'email.required' => 'メールアドレスをご記入ください',
            'email.unique' => 'メールアドレス既に存在します',
            'password.required' => 'パスワードをご記入ください',
            'permission_id.required' => 'ユーザには立場が必要です',
        ];
    }
}
