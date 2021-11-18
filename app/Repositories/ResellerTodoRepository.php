<?php
//phpcs:disable
namespace App\Repositories;

use App\Interfaces\ResellerTodoInterface;
use App\Models\ResellerTodo;
use Carbon\Carbon;

class ResellerTodoRepository implements ResellerTodoInterface
{
    private function getTodoQuery(){
        return (new ResellerTodo()) ->select(
                'reseller_todo.id',
                'reseller_todo.subject',
                'reseller_todo.date_create',
                'reseller_todo.status',
                'reseller_todo.prio',
                'reseller_todo.owner_id',
                'reseller_todo.user_id',
                'reseller_todo.message',
                'reseller_todo.client_id',
                'clients.company',
                'clients.city',
                'clients.tel',
                /* 'clients_domains.domain', */
                'clients.login AS username',
                'ru.login AS user_name',
                'ruo.login AS owner_name'
            )
            ->where('reseller_todo.deleted', 0)
            ->leftJoin('clients', 'reseller_todo.client_id', '=', 'clients.id')
            /* ->leftJoin('client_domains', 'clients.id', '=', 'client_domains.client_id') */
            ->leftJoin('reseller_users AS ru', 'reseller_todo.user_id', '=', 'ru.id')
            ->leftJoin('reseller_users AS ruo', 'reseller_todo.owner_id', '=', 'ruo.id');
    }

    public function getTodoList()
    {
        return $this->getTodoQuery()
            ->orderBy('reseller_todo.id', 'DESC')
            ->paginate(20);
    }

    public function getOneTodo($todoId)
    {
        return $this->getTodoQuery()
            ->where('reseller_todo.id', $todoId)
            ->first();
    }

    public function saveTodo($request)
    {
        $validatedData = $request->validated();
        $timeArray = [ 'date_create' => (new Carbon())::now()->toDateTimeString()];
        $mergedData = array_merge($validatedData, $timeArray);
        (new ResellerTodo())->create($mergedData);
    }

    public function updateTodo($editRequest, $todoId)
    {
        $validatedData = $editRequest->validated();
        (new ResellerTodo())->findOrFail($todoId)->update($validatedData);
    }

    public function deleteTodo($todoId)
    {
        $todo = (new ResellerTodo())->findOrFail($todoId);
        $todo->update(['deleted' => 1]);
    }

    public function updateTodoOwner($editOwnerRequest, $todoId)
    {
        $validatedData = $editOwnerRequest->validated();
        (new ResellerTodo())->findOrFail($todoId)->update($validatedData);
    }

    public function filterSearchResults($requestSearch)
    {
        return $this->getTodoQuery()
            ->getSubject($requestSearch->subject)
            ->getStatus($requestSearch->status)
            ->getPrio($requestSearch->prio)
            ->getUserId($requestSearch->user_id)
            ->getOwnerId($requestSearch->owner_id)
            ->getCompanyName($requestSearch->client_id);
    }
}
