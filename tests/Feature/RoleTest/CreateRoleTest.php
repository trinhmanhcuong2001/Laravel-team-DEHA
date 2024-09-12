<?php

namespace Tests\Feature\RoleTest;

use App\Models\Role;
use App\Models\User;
use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateRoleTest extends TestCase
{
    use DatabaseTransactions;
    
    public function createRoleViewRoute()
    {
        return route('roles.create');
    }

    public function createRoleRoute()
    {
        return route('roles.store');
    }

    public function createUserSuperAdmin()
    {
        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }
    
    /** @test */
    public function user_can_see_view_create_role(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $response = $this->get($this->createRoleViewRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.create');
    }

    /** @test */
    public function user_can_create_role_if_data_vali(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::factory()->make();
        $response = $this->post($this->createRoleRoute(), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', ['name' => $role['name']]);
        $response->assertRedirect(route('roles.index'));
    }

    /** @test */
    public function user_can_not_create_role_if_name_field_is_null(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::factory(['name' => null])->make();
        $response = $this->post($this->createRoleRoute(), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function user_can_not_create_role_if_description_field_is_null(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::factory(['description' => null])->make();
        $response = $this->post($this->createRoleRoute(), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('description');
    }
}
