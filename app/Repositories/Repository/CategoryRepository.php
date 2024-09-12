<?php

namespace App\Repositories\Repository;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function findByParentId($parentId = null)
    {
        return Category::where('parent_id', $parentId)->get();
    }
}
