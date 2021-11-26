<?php
//phpcs:disable
namespace App\Repositories;

use App\Interfaces\PriorityScaleInterface;
use App\Models\PriorityScale;

class PriorityScaleRepository implements PriorityScaleInterface 
{
    public function __construct (PriorityScale $priorityScale)
    {
        $this->priority = $priorityScale;
    }

    public function createPriority($requestData)
    {
        return $this->priority->create($requestData);
    }

    public function editPriority($prioId, $requestData)
    {
        return $this->priority->find($prioId)->update($requestData);
    }

    public function deletePriority($prioId)
    {
        return $this->priority->find($prioId)->delete();
    }
}
