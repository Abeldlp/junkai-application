<?php
//phpcs:disable
namespace App\Http\Controllers;

use App\Http\Requests\EditTaskTypeRequest;
use App\Http\Requests\SaveTaskTypeRequest;
use App\Interfaces\TaskTypeInterface;

class TaskTypeController extends Controller
{
    public function __construct(TaskTypeInterface $taskTypeInterface)
    {
        $this->interface = $taskTypeInterface;
    }

    public function create(SaveTaskTypeRequest $request)
    {
        $validatedData = $request->validated();
        $this->interface->createNewTaskType($validatedData);
    }

    public function edit($taskTypeId, EditTaskTypeRequest $request)
    {
        $validatedData = $request->validated();
        $this->interface->editTaskType($taskTypeId, $validatedData);
    }

    public function destroy($taskTypeId)
    {
        $this->interface->deleteTaskType($taskTypeId);
    }
}
