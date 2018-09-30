<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Capture::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'city' => $faker->city,
        'date' => $faker->dateTimeBetween('+10 days', '+1 years'),
        'address' => $faker->address,
        'information' => $faker->paragraph(2),
        'state' => $faker->randomElement([
            'to study',
            'in process',
            'done'
        ])
    ];
});