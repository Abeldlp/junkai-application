<?php
//phpcs:disable
namespace App\Http\Controllers;

use App\Interfaces\UserInterface;
use App\Http\Requests\SaveUserRequest;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{
    public function __construct(UserInterface $userInterface)
    {
        $this->interface = $userInterface;
    }

    public function create(SaveUserRequest $requestData)
    {
        $validateData = $requestData->validated();
        $this->interface->createUser($validateData);
    }

    public function edit($userId, EditUserRequest $requestData)
    {
        $validateData = $requestData->validated();
        $this->interface->editUser($userId, $validateData);
    }

    public function delete($userId)
    {
        $this->interface->deleteUser($userId);
    }
}
