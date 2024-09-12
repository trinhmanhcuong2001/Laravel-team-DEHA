<?php

namespace Tests\Feature\CategoryTest;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function updateViewRoute($id)
    {
        return route('categories.edit', $id);
    }

    public function updateCategoryRoute($id)
    {
        return route('categories.update', $id);
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
    public function user_can_see_view_update()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $category = Category::create([
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ]);
        $response = $this->get($this->updateViewRoute($category->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.edit');
    }

    /** @test */
    public function user_can_update_category_if_data_valid()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $category = Category::create([
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ]);
        $updateData = [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ];
        $response = $this->put($this->updateCategoryRoute($category->id), $updateData);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['name' => $updateData['name']]);
    }

    /** @test */
    public function user_can_not_update_category_if_data_not_valid()
    {
        $this->actingAs($this->createUserSuperAdmin());
        
        $category = Category::create([
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ]);
        $updateData = [
            'name' => null,
            'description' => $this->faker->text,
            'parent_id' => null
        ];

        $response = $this->put($this->updateCategoryRoute($category->id), $updateData);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('name');
    }
}
