<?php

namespace Tests\Feature\CategoryTest;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetListCategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function categoryGetListRoute()
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
    public function user_can_see_list_category()
    {
        $this->actingAs($this->createUserSuperAdmin());

        $category = Category::create([
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'parent_id' => null
        ]);
        $response = $this->get($this->categoryGetListRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.categories.index');
        $response->assertSee($category['name']);
    }
}
