<?php

namespace Tests\Feature\AuthenticateTest;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class LogInTest extends TestCase
{
    use DatabaseTransactions;

    public function logInViewRoute()
    {
        return route('admin.login');
    }

    public function logInRoute()
    {
        return route('admin.postLogin');
    }
    /** @test */
    public function user_can_see_view_log_in()
    {
        $response = $this->get($this->logInViewRoute());
        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('admin.authenticate.login');
    }

    /** @test */
    public function user_can_log_in_if_account_is_correct()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post($this->logInRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');
    }

    /** @test */
    public function user_can_not_log_in_if_account_incorrect()
    {
        $response = $this->post($this->logInRoute());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHas('error');
    }

    /** @test */
    public function user_can_not_see_view_log_in_if_logger_in()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get($this->logInViewRoute());
        $response->assertRedirect('/');
    }
}
