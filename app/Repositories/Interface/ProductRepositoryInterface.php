<?php

namespace App\Repositories\Interface;

use App\Http\Requests\ProductRequest\StoreProductRequest;
use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll($request);
    public function store($request);
}
