<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->all();
    }

    public function getCategoryById($categoryId)
    {
        return $this->categoryRepository->find($categoryId);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory($categoryId, array $data)
    {
         return $this->categoryRepository->update($categoryId, $data);
    }

    public function deleteCategory($categoryId)
    {
       
        return $this->categoryRepository->delete($categoryId);
    }

    public function getCategoriesByParentId($parentId = null)
    {
        return $this->categoryRepository->findByParentId($parentId);
    }
}
