<?php

namespace Tests\Feature\ProductTest;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    private function listProductRoute()
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
    public function user_can_get_list_product(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $response = $this->get($this->listProductRoute());
        $response->assertViewIs('admin.products.index');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_cant_get_list_product_if_dont_auth()
    {
        $response = $this->get($this->listProductRoute());
        $response->assertRedirect($this->loginRoute());
        $response->assertStatus(Response::HTTP_FOUND);
    }


}
