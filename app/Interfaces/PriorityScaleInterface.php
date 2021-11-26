<?php
//phpcs:disable
namespace App\Interfaces;

interface PriorityScaleInterface {
    public function createPriority($requestData);
    public function editPriority($prioId, $requestData);
    public function deletePriority($prioId);
}
