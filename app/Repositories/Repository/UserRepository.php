<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function search($search)
    {
        return $this->model->where('name', 'like', '%' . $search . '%')
                           ->orWhere('email', 'like', '%' . $search . '%')
                           ->get();
    }
    public function create(array $data)
    {
        if ($this->model->where('email', $data['email'])->exists()) {
            throw new \Exception('Email already exists');
        }
        return parent::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);

        return $user;
    }

    public function addRole($userId, array $roles)
    {
        $user = $this->find($userId);
        $user->roles()->attach($roles);
    }
    public function updateRoles($userId, $roles)
    {
        $user = $this->find($userId);
        $user->roles()->sync($roles); 
    }
}
?>
