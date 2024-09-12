<?php

namespace Tests\Feature\RoleTest;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteRoleTest extends TestCase
{
    use DatabaseTransactions;

    public function deleteRoleRoute($id)
    {
        return route('roles.destroy', $id);
    }

    public function getRoleRoute()
    {
        return route('roles.index');
    }

    public function createUserSuperAdmin()
    {
        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }
    /** @test */
    public function user_can_delete_role_if_role_exits()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::factory()->create();
        $response = $this->delete($this->deleteRoleRoute($role->id));
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect($this->getRoleRoute());
    }

    /** @test */
    public function user_can_not_delete_role_if_role_is_not_exits()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $roleId = -1;
        $response = $this->delete(route('roles.destroy', $roleId));
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
