<?php

namespace Tests\Feature\UserTest;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateUserTest extends TestCase
{
    use DatabaseTransactions;

    public function updateUserRoute($userId)
    {
        return route('users.update', $userId);
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
    public function user_can_update_user_with_valid_data(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        
        $role = Role::firstOrCreate(['name' => 'super-admin'], ['description' => 'This is role super admin']);
        $user = User::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
            'roles' => [$role->id],
        ];

        $response = $this->put($this->updateUserRoute($user->id), $updatedData);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /** @test */
    public function user_can_not_update_user_with_invalid_email(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $user = User::factory()->create();
        
        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'invalid-email',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        $response = $this->put($this->updateUserRoute($user->id), $updatedData);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_can_not_update_user_with_non_matching_password_confirmation(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $user = User::factory()->create();
        
        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'differentpassword',
        ];

        $response = $this->put($this->updateUserRoute($user->id), $updatedData);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('password');
    }
}
