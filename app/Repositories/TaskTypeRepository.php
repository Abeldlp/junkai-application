<?php
//phpcs:disable
namespace App\Repositories;

use App\Models\TaskType;
use App\Interfaces\TaskTypeInterface;

class TaskTypeRepository implements TaskTypeInterface {

    public function __construct(TaskType $taskType)
    {
        $this->type = $taskType;
    }

    public function createNewTaskType($requestData)
    {
        return $this->type->create($requestData);
    }

    public function editTaskType($taskTypeId, $requestData)
    {
        return $this->type->find($taskTypeId)->update($requestData);
    }

    public function deleteTaskType($taskTypeId)
    {
        return $this->type->find($taskTypeId)->delete();
    }
}
