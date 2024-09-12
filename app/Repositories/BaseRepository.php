<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model; 
    }

    public function all($relations = [])
    {
        if(!empty($relations)){
            return $this->model->with($relations)->get();
        }
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->find($id);
        $record->delete();
        return $record;
    }

    public function paginate($limit)
    {
        return $this->model::query()->paginate($limit);
    }
}
?>