<?php
//phpcs:disable

namespace App\Interfaces;

interface UserInterface {
    public function createUser($requestData);
    public function editUser($userId, $requestData);
    public function deleteUser($userId);
    public function loginUser($userData);
}
