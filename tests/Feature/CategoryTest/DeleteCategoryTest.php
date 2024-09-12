<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function deleteCategoryRoute($id)
    {
        return route('categories.destroy', $id);
    }

    public function getListCategoryRoute()
    {
        return route('categories.index');
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
    public function user_can_delete_category_if_exists()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $category = Category::create([
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ]);

        $response = $this->delete($this->deleteCategoryRoute($category->id));
        $response->assertRedirect($this->getListCategoryRoute());
        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function user_can_not_delete_category_if_category_not_exists()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $categoryId = -1;
        $response = $this->delete($this->deleteCategoryRoute($categoryId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
