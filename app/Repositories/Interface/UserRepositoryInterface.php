<?php

namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function search($search);

    public function addRole($userId, array $role);

    public function updateRoles($userId, array $role);
    
}
?>