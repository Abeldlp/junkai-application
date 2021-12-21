<?php
//phpcs:disable
namespace App\Interfaces;

interface TaskTypeInterface {
    public function createNewTaskType($requestData);
    public function editTaskType($taskTypeId, $requestData);
    public function deleteTaskType($taskTypeId);
}
