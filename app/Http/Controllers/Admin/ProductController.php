<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest\StoreProductRequest;
use App\Http\Requests\ProductRequest\UpdateProductRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' ', $arr);
        View::share('title', $title);
        $this->middleware('auth');
        $this->middleware('checkPermission:create-product')->only(['create', 'store']);
        $this->middleware('checkPermission:edit-product')->only(['edit', 'update']);
        $this->middleware('checkPermission:delete-product')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listStatus = $this->productService->getListStatusProduct();
        $listCategories = $this->categoryService->getAllCategories();
        return view('admin.products.index', [
            'listStatus' => $listStatus,
            'listCategories' => $listCategories,
        ]);
    }

    public function getListProductApi(Request $request)
    {
        $products = $this->productService->getListProduct($request);
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listStatus = $this->productService->getListStatusProduct();
        $listCategories = $this->categoryService->getAllCategories();
        return view('admin.products.create', [
            'listCategories' => $listCategories,
            'listStatus' => $listStatus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->storeProduct($request);
        return redirect()->route('products.index')
            ->with('success', 'Create product successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->productService->getApiProductById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listStatus = $this->productService->getListStatusProduct();
        $listCategories = $this->categoryService->getAllCategories();
        $product = $this->productService->getProductById($id);
        return view('admin.products.edit', [
            'product' => $product,
            'listCategories' => $listCategories,
            'listStatus' => $listStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $this->productService->updateProduct($id, $request);
        return redirect()->route('products.index')
            ->with('success', 'Update product successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
