<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_cant_access_home_page_when_not_logged()
    {
        $response = $this->get(route('home'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_access_home_page_when_logged()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertViewIs('home');
    }
}
