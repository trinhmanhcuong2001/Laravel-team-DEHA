<?php

namespace Tests\Feature\AuthenticateTest;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogOutTest extends TestCase
{
    use DatabaseTransactions;

    public function logoutRoute()
    {
        return route('admin.logout');
    }

    public function loginRoute()
    {
        return route('admin.login');
    }
    /** @test */
    public function user_can_log_out()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get($this->logoutRoute());
        $response->assertRedirect($this->loginRoute());
        $this->assertGuest();
    }
}
