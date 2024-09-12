<?php

namespace App\Services;

use App\Repositories\Interface\RoleRepositoryInterface;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRole($relations)
    {
        return $this->roleRepository->all($relations);
    }

    public function createRole($data)
    {
        return $this->roleRepository->create($data);
    }

    public function findRole($id)
    {
        return $this->roleRepository->find($id);
    }

    public function updateRole($id, $data)
    {
        return $this->roleRepository->update($id, $data);
    }

    public function deleteRole($id)
    {
        return $this->roleRepository->delete($id);
    }

    public function addPermissions($id, $data)
    {
        if (is_null($data)) {
            $data = [];
        }
        return $this->roleRepository->addPermission($id, $data);
    }

    public function updatePermissions($id, $data)
    {
        if (is_null($data)) {
            $data = [];
        }
        return $this->roleRepository->updatePermission($id, $data);
    }

    public function searchRole($keyword)
    {
        return $this->roleRepository->search($keyword);
    }
}
?>