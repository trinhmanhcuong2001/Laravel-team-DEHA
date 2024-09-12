<?php

namespace Tests\Feature\AuthenticateTest;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function registerViewRoute()
    {
        return route('admin.register');
    }

    public function registerRoute()
    {
        return route('admin.postRegister');
    }
    /** @test */
    public function user_can_see_view_register()
    {
        $response = $this->get($this->registerViewRoute());
        $response->assertViewIs('admin.authenticate.register');
        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function user_can_register_if_data_valid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post($this->registerRoute(), $user->toArray());
        $this->assertDatabaseHas('users', ['email' => $user->email]);
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/');
    }

    /** @test */
    public function user_can_not_register_if_email_is_not_valid()
    {
        $user = User::factory(['email' => ''])->make();
        $response = $this->post($this->registerRoute(), $user->toArray());
        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_can_not_view_register_if_logger_in()
    {
        $this->actingAs(User::factory(['email' => 'cuong@deha-soft.com'])->create());
        $response = $this->get($this->registerViewRoute());
        $response->assertRedirect('/');

    }
}
