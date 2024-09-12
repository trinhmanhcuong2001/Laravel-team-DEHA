<?php

namespace Tests\Feature\ProductTest;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    public function createProductViewRoute()
    {
        return route('products.create');
    }

    public function storeProductRoute()
    {
        return route('products.store');
    }

    public function createUserSuperAdmin()
    {
        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }

    /** @test */
    public function user_can_see_create_product_view(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $response = $this->get($this->createProductViewRoute());
        $response->assertViewIs('admin.products.create');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_cant_see_create_product_view_if_dont_auth(): void
    {
        $response = $this->get($this->createProductViewRoute());
        $response->assertRedirect(route('admin.login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function user_cant_create_product_if_data_is_not_valid(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $product = [
            'name' => null,
            'sale_price' => null,
            'old_price' => null,
            'quantity' => null,
            'description' => null,
            'status' => null,
            'thumb' => null,
        ];
        $response = $this->post($this->storeProductRoute(), $product);
        $response->assertSessionHas('errors');
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function user_cant_create_product_if_dont_auth(): void
    {
        $product = Product::factory()->make()->toArray();
        $response = $this->post($this->storeProductRoute(), $product);
        $response->assertRedirect(route('admin.login'));
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function user_can_create_product_if_data_is_valid()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $product = Product::factory()->make()->toArray();
        $response = $this->post($this->storeProductRoute(), $product);
        $response->assertRedirect(route('products.index'));
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas('success');
    }


}
