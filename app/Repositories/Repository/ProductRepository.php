<?php

namespace App\Repositories\Repository;

use App\Http\Requests\ProductRequest\StoreProductRequest;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Traits\HandleImage;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getAll($request)
    {
        $listProducts = $this->model::filter($request->all())->paginate($request->per_page);
        $listProducts->appends($request->all());
        return $listProducts;
    }


    public function store($request)
    {
        $product = $this->model::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'old_price' => $request->old_price,
            'sale_price' => $request->sale_price,
            'thumb' => $request->thumb,
            'status' => $request->status,
        ]);

        $product->categories()->sync($request->categories);
        return $product;
    }

    public function update($id, $data)
    {
        $product = $this->model::query()->findOrFail($id);

        $updateData = [
            'name' => $data->name,
            'description' => $data->description,
            'quantity' => $data->quantity,
            'sale_price' => $data->sale_price,
            'status' => $data->status,
            'old_price' => $data->old_price,
        ];

        // Kiểm tra và cập nhật thumb nếu có giá trị
        if (isset($data->thumb) && !is_null($data->thumb)) {
            $updateData['thumb'] = $data->thumb;
        }

        $product->update($updateData);

        // Đồng bộ lại các danh mục
        $product->categories()->sync($data->categories);
    }
}
