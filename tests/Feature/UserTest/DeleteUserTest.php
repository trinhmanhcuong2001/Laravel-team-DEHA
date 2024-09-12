<?php

namespace Tests\Feature\UserTest;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteUserTest extends TestCase
{
    use DatabaseTransactions;

    public function deleteUserRoute($userId)
    {
        return route('users.destroy', $userId);
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
    public function user_can_delete_user(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $user = User::factory()->create();

        $response = $this->delete($this->deleteUserRoute($user->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function deleting_non_existent_user_returns_error(): void
    {
        $this->actingAs($this->createUserSuperAdmin());
        $nonExistentUserId = 999;

        $response = $this->delete($this->deleteUserRoute($nonExistentUserId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
