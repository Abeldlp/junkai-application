<?php
//phpcs:disable
namespace App\Http\Controllers;

use App\Interfaces\PriorityScaleInterface;
use App\Http\Requests\SavePriorityScaleRequest;
use app\Http\Requests\EditPriorityScaleRequest;

class PriorityScaleController extends Controller
{
    public function __construct(PriorityScaleInterface $priorityScaleInterface)
    {
        $this->interface = $priorityScaleInterface;
    }

    public function create(SavePriorityScaleRequest $requestData)
    {
        $validateData = $requestData->validated();
        $this->interface->createPriority($validateData);
    }

    public function edit($prioId, EditPriorityScaleRequest $requestData)
    {
        $validateData = $requestData->validated();
        $this->interface->editPriority($prioId, $validateData);
    }

    public function delete($prioId)
    {
        $this->interface->deletePriority($prioId);
    }
}
