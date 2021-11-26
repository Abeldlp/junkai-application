<?php
//phpcs:disable
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTaskRequest extends FormRequest
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
            'task_type_id' => 'integer',
            'owner_id' => 'integer',
            'created_by' => 'integer',
            'task_priority' => 'integer',
            'completed' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'task_type_id.required' => '巡回する項目をお選びください',
            'owner_id.required' => '巡回タスクの責任者をお選びください',
            'task_priority.required' => '巡回の優先順位をお選びください',
        ];
    }
}
