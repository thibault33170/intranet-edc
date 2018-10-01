<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
        'address' => $faker->address,
        'dob' => $faker->dateTimeBetween('-60 years', '-18 years'),
        'fa' => $faker->boolean(50),
        'capture' => $faker->boolean(40),
        'feeding' => $faker->boolean(40),
        'member' => $faker->boolean(40),
    ];
});
