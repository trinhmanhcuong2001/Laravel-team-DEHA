<?php

namespace Tests\Feature\ProductTest;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditProductTest extends TestCase
{
    public function editProductViewRoute($id)
    {
        return route('products.edit', $id);
    }

    public function updateProductRoute($id)
    {
        return route('products.update', $id);
    }

    public function listProductRoute()
    {
        return route('products.index');
    }

    public function loginRoute()
    {
        return route('admin.login');
    }

    public function createUserSuperAdmin()
    {
        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }
    /** @test */
    public function user_cant_see_view_edit_if_dont_auth(): void
    {
        $request = Product::factory()->make()->toArray();
        unset($request['categories']);
        $product = Product::query()->create($request);
        $response = $this->get($this->editProductViewRoute($product->id));
        $response->assertRedirect($this->loginRoute());
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function user_can_see_view_if_auth(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $request = Product::factory()->make()->toArray();
        unset($request['categories']);
        $product = Product::query()->create($request);
        $response = $this->get($this->editProductViewRoute($product->id));
        $response->assertViewHas('product', $product);
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_cant_update_product_if_data_not_valid(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $request = Product::factory()->make()->toArray();
        unset($request['categories']);
        $newData = [];
        $product = Product::query()->create($request);
        $response = $this->put($this->updateProductRoute($product->id), $newData);
        $response->assertSessionHas('errors');
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function user_can_update_product_if_data_valid(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $request = Product::factory()->make()->toArray();
        unset($request['categories']);
        $newData = Product::factory()->make()->toArray();
        $newData['new_thumb'] = null;

        $product = Product::query()->create($request);
        $response = $this->put($this->updateProductRoute($product->id), $newData);
        $response->assertRedirect($this->listProductRoute());
        $response->assertStatus(Response::HTTP_FOUND);
    }

}
