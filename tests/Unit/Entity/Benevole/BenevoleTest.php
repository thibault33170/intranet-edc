<?php

namespace Tests\Unit\Entty\Benevole;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class BenevoleTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function it_can_create_a_benevole()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'address' => $this->faker->address,
            'dob' => $this->faker->dateTimeBetween('-60 years', '-18 years'),
            'fa' => $this->faker->boolean(50),
            'capture' => $this->faker->boolean(40),
            'feeding' => $this->faker->boolean(40),
            'member' => $this->faker->boolean(40),
        ];

        $user = \App\User::create($data);

        $this->assertInstanceOf(\App\User::class, $user);
        $this->assertNotNull($user);
    }
}
