<?php

namespace App\Services;

use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function searchUsers($search)
    {
        return $this->userRepository->search($search);
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function getUserById($userId)
    {
        return $this->userRepository->find($userId);
    }

    public function updateUser($userId, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($userId, $data);
    }

    public function deleteUser($userId)
    {
        return $this->userRepository->delete($userId);
    }

    public function addRoles($userId, $roles)
    {
        return $this->userRepository->addRole($userId, $roles);
    }
    public function updateRoles($userId, $roles)
    {
        return $this->userRepository->updateRoles($userId, $roles);
    }
}
