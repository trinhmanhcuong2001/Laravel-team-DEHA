<?php

namespace Tests\Feature\UserTest;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateUserTest extends TestCase
{
    use DatabaseTransactions;

    public function createUserViewRoute()
    {
        return route('users.create');
    }

    public function createUserRoute()
    {
        return route('users.store');
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
    public function user_can_see_view_create_user(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        
        $response = $this->get($this->createUserViewRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.create');
    }

    /** @test */
    public function user_can_create_user_if_data_is_valid(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::firstOrCreate(['name' => 'super-admin'], ['description' => 'This is role super admin']);
        $response = $this->post($this->createUserRoute(), [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'roles' => [$role->id],
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('users', ['email' => 'super-admin@gmail.com']);
        $response->assertRedirect(route('users.index'));
    }

    /** @test */
    public function user_can_not_create_user_if_name_field_is_null(): void
    {
        $this->actingAs($this->createUserSuperAdmin());

        $user = User::factory()->make(['name' => null]);
        $response = $this->post($this->createUserRoute(), $user->toArray());

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('name');
    }
}
