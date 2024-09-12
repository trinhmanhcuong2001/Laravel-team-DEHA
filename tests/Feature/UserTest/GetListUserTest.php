<?php

namespace Tests\Feature\UserTest;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetListUserTest extends TestCase
{
    use DatabaseTransactions;

    public function getListUserRoute()
    {
        return route('users.index');
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
    public function user_can_see_list_user(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $user = User::factory()->create();
        
        $response = $this->get($this->getListUserRoute());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.users.index');
        $response->assertSee($user['name']);
    }
}
