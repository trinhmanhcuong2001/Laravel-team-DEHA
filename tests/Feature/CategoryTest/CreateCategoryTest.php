<?php

namespace Tests\Feature\CategoryTest;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function categoryViewRoute()
    {
        return route('categories.create');
    }

    public function categoryCreateRoute()
    {
        return route('categories.store');
    }

    public function createUserSuperAdmin()
    {

        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
            'role' => 'super-admin',
        ]);
    }
    /** @test */
    public function user_can_see_view_create_category()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $response = $this->get($this->categoryViewRoute());
        $response->assertViewIs('admin.categories.create');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_can_create_category_if_data_valid()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $category = Category::create([
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ]);
        $response = $this->post($this->categoryCreateRoute(), $category->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['name' => $category['name']]);
    }

    /** @test */
    public function user_can_not_create_category_if_data_not_valid()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $category = [
            'name' => null,
            'descript' => null,
            'parent_id' => null
        ];
        $response = $this->post($this->categoryCreateRoute(), $category);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('description');
    }
}
