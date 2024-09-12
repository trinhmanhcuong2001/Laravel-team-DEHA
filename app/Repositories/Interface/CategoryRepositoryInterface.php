<?php

namespace App\Repositories\Interface;

use App\Repositories\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function findByParentId($parentId = null);
}
