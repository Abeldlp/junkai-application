<?php
//phpcs:disable
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTaskRequest extends FormRequest
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
            'task_type_id' => 'integer|nullable',
            'owner_id' => 'integer|nullable',
            'created_by' => 'integer|nullable',
            'task_priority' => 'integer|nullable',
            'completed' => 'boolean|nullable'
        ];
    }
}
