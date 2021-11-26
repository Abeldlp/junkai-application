<?php
//phpcs:disable
namespace App\Http\Controllers;

use App\Interfaces\TaskInterface;
use App\Http\Requests\SaveTaskRequest;
use App\Http\Requests\EditTaskRequest;

class TaskController extends Controller
{
    public function __construct(TaskInterface $taskInterface)
    {
        $this->interface = $taskInterface;
    }

    public function create(SaveTaskRequest $saveTaskRequest)
    {
        $validateData = $saveTaskRequest->validated();
        $this->interface->createNewTask($validateData);
    }

    public function edit($taskId, EditTaskRequest $saveTaskRequest)
    {
        $validateData = $saveTaskRequest->validated();
        $this->interface->editTask($taskId, $validateData);
    }

    public function destroy($taskId)
    {
        $this->interface->deleteTask($taskId);
    }
}
