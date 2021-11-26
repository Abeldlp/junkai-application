<?php
//phpcs:disable
namespace App\Repositories;

use App\Models\Task;
use App\Interfaces\TaskInterface;

class TaskRepository implements TaskInterface {

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function createNewTask($requestData)
    {
        return $this->task->create($requestData);
    }

    public function editTask($taskId, $requestData)
    {
        return $this->task->find($taskId)->update($requestData);
    }

    public function deleteTask($taskId)
    {
        return $this->task->find($taskId)->delete();
    }
}
