<?php
//phpcs:disable
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTaskTypeRequest extends FormRequest
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
            'type_name' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
            'type_name.required' => 'タイプネームをご記入ください'
        ];
    }
}
