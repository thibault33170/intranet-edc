<?php

use App\Cat;
use Faker\Generator as Faker;

$factory->define(Cat::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'dob' => $faker->dateTime(),
        'color' => $faker->colorName,
        'state' => $faker->randomElement(['to reserve', 'reserved', 'to adopt', 'adopted'])
    ];
});
