<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function all($relations = []);

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}

?>
