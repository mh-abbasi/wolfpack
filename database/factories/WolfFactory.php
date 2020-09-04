<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Wolf;
use Faker\Generator as Faker;

$factory->define(Wolf::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'gender' => $faker->randomElement(['m','f','o']),
        'birthdate' => $faker->date(),
        'location' => $faker->latitude.','.$faker->longitude
    ];
});
