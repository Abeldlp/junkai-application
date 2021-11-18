<?php
//phpcs:disable
namespace App\Interfaces;

interface ResellerTodoInterface
{
    public function getTodoList();
    public function getOneTodo($todoId);
    public function saveTodo($todoToSave);
    public function updateTodo($editREquest, $todoId);
    public function deleteTodo($todoId);
    public function updatetodoOwner($editOwnerRequest, $todoId);
    public function filterSearchResults($requestSearch);
}


