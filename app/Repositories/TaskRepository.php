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
        dd('we are in the repository');
        dd($requestData);
    }

}
