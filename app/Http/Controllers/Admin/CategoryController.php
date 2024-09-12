<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CategoryRequest\CreateCategoryRequest;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' ', $arr);
        View::share('title', $title);
        $this->middleware('auth');
        $this->middleware('checkPermission:create-category')->only(['create', 'store']);
        $this->middleware('checkPermission:edit-category')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete-category')->only(['destroy']);
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();
        $this->categoryService->createCategory($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit($categoryId)
    {
        $category = $this->categoryService->getCategoryById($categoryId);
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CreateCategoryRequest $request, $categoryId)
    {
        $validated = $request->validated();

        $this->categoryService->updateCategory($categoryId, $validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($categoryId)
    {
        $this->categoryService->deleteCategory($categoryId);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
