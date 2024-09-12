<?php

namespace Tests\Feature\RoleTest;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchRoleTest extends TestCase
{
    use DatabaseTransactions;

    public function searchRoleRoute()
    {
        return route('roles.search');
    }
    
    public function createUserSuperAdmin()
    {
        return User::firstOrCreate(['email' => 'super-admin@gmail.com'], [
            'name' => 'Super Admin',
            'password' => bcrypt('12345678'),
        ]);
    }
    /** @test */
    public function user_can_see_role_if_role_exits()
    {
        $this->actingAs($this->createUserSuperAdmin());
        $role = Role::factory()->create();
        $response = $this->getJson($this->searchRoleRoute());
        $response->assertJson(fn (AssertableJson $json) => 
            $json->has('html')
        );
    }
}
