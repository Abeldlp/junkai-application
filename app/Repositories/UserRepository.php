<?php
//phpcs:disable
namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface {

    public function __construct (User $user)
    {
        $this->user = $user;
    }

    public function createUser($requestData)
    {
        $hashedPassword = $this->hashUserPassword($requestData['password']);
        $dataToSave = array_merge(
            $requestData, 
            [ 
                'password' => $hashedPassword,
            ]
        );
        return $this->user->create($dataToSave);
    }

    public function editUser($userId, $requestData)
    {
        return $this->user->find($userId)->update($requestData);
    }

    public function deleteUser($userId)
    {
        return $this->user->find($userId)->delete();
    }

    private function hashUserPassword($userPassword)
    {
        return Hash::make($userPassword);
    }

    public function loginUser($userData)
    {
        $user = User::where('email', $userData['email']);
        $correctPassword = Hash::check($userData['password'], $user->password);
        return $correctPassword ? Auth::login($user) : 'Not correct password';
    }
}
