<?php

namespace Tests\Feature\RoleTest;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetListRoleTest extends TestCase
{
    use DatabaseTransactions;

    public function getListRoleRoute()
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
    public function user_can_see_list_role()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::factory()->create();
        $response = $this->get($this->getListRoleRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.roles.index');
        $response->assertSee($role['name']);
    }
}
