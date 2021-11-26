<?php
//phpcs:disable
namespace App\Http\Controllers;

use App\Interfaces\TaskInterface;
use App\Http\Requests\SaveTaskRequest;

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
}
