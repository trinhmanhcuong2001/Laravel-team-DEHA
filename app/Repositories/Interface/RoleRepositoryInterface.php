<?php

namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function all($relations = []);

    public function addPermission($id, array $data);

    public function updatePermission($id, array $data);

    public function search($keyword);
}
