<?php
//phpcs:disable
namespace App\Interfaces;

interface TaskInterface {
    public function createNewTask($requestData);
    public function editTask($taskId, $requestData);
    public function deleteTask($taskId);
}
