<?php

namespace App\Services;

use App\Enums\ProductStatusEnums;
use App\Http\Requests\ProductRequest\StoreProductRequest;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Traits\HandleImage;

class ProductService
{
    use HandleImage;

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository){
        $this->productRepository = $productRepository;
    }

    public function getListProduct($request)
    {
        $products = $this->productRepository->getAll($request);
        foreach ($products as $product) {
            $product->status = ProductStatusEnums::getNameStatus($product->status);
            $product->thumb = $product->path($product->thumb);
            $product['categories'] = $product->categories;
        }
        return [
            'data' => $products->items(),
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem()
            ],
        ];
    }

    public function getListStatusProduct()
    {
        $listStatusProduct = ProductStatusEnums::getArrayStatus();
        return $listStatusProduct;
    }

    public function storeProduct(StoreProductRequest $request)
    {
        $request->thumb = $this->uploadImage($request->thumb);
        return $this->productRepository->store($request);
    }

    public function updateProduct($id, $request)
    {
        $product = $this->productRepository->find($id);
        if ($product){
            if ($request->new_thumb != null) {
                $this->deleteImage('uploads/product/'.$product->thumb);
                $request->thumb = $this->uploadImage($request->new_thumb);
            }else{
                $request->thumb = $product->thumb;
            }
            return $this->productRepository->update($id, $request);
        }else{
            return false;
        }
    }

    public function getApiProductById($id)
    {
        $product = $this->productRepository->find($id);
        $product->status = ProductStatusEnums::getNameStatus($product->status);
        $product->thumb = $product->path($product->thumb);
        $product['categories'] = $product->categories;
        return response()->json($product);
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->find($id);
        $product->status = ProductStatusEnums::getNameStatus($product->status);
        $product->thumb = $product->path($product->thumb);
        $product['categories'] = $product->categories;
        return $product;
    }

}
