<?php

namespace Tests\Feature\RoleTest;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateRoleTest extends TestCase
{
    use DatabaseTransactions;
    
    public function editRoleViewRoute($id)
    {
        return route('roles.edit', $id);
    }

    public function updateRoleRoute($id)
    {
        return route('roles.update', $id);
    }

    public function createUserSuperAdmin()
    {
        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }

    public function createRoleAdmin()
    {
        return Role::firstOrCreate(['name' => 'Admin'], ['description' => 'This is role admin']);
    }
    /** @test */
    public function user_can_see_view_edit_role(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = $this->createRoleAdmin();
        $response = $this->get($this->editRoleViewRoute($role->id));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.edit');
        $response->assertSee($role['name']);
    }

    /** @test */
    public function user_can_edit_role_if_data_vali(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = $this->createRoleAdmin();
        $response = $this->put($this->updateRoleRoute($role->id), $role->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('roles', ['name' => $role['name']]);
        $response->assertRedirect('roles');
    }

    /** @test */
    public function user_can_not_edit_role_if_name_field_is_null(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = $this->createRoleAdmin();
        $dataUpdate = Role::factory(['name' => null])->make();
        $response = $this->put($this->updateRoleRoute($role->id), $dataUpdate->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function user_can_not_edit_role_if_description_field_is_null(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = $this->createRoleAdmin();
        $dataUpdate = Role::factory(['description' => null])->make();
        $response = $this->put($this->updateRoleRoute($role->id), $dataUpdate->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_see_name_required_text_if_name_field_is_null()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = $this->createRoleAdmin();
        $dataUpdate = Role::factory(['name' => null])->make();
        $response = $this->from($this->editRoleViewRoute($role->id))
        ->put($this->updateRoleRoute($role->id), $dataUpdate->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect($this->editRoleViewRoute($role->id));
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function user_can_not_update_role_if_role_is_not_exits()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $roleId = -1;
        $dataUpdate = $this->createRoleAdmin();
        $response = $this->put($this->updateRoleRoute($roleId), $dataUpdate->toArray());
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
