<?php

namespace App\Repositories\Repository;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function all($relations = [])
    {
        $query = $this->model->newQuery();

        if (!empty($relations)) {
            $query->with($relations);
        }

        // Loại bỏ bản ghi với 'name' là 'super-admin'
        $query->where('name', '!=', 'super-admin');

        return $query->get();
    }

    public function addPermission($id, array $data)
    {
        $role = $this->find($id);
        $role->permissions()->sync($data);
        return $role;
    }

    public function updatePermission($id, array $data)
    {
        $role = $this->find($id);
        $role->permissions()->sync($data);
    }

    public function search($keyword)
    {
        return $this->model->ofKey($keyword)->with('permissions')->get();
    }
}
