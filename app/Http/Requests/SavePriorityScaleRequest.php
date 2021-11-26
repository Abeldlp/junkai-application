<?php
//phpcs:disable
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePriorityScaleRequest extends FormRequest
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
            'priority_name' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'priority_name.required' => '優先順位をお選びください'
        ];
    }
}
