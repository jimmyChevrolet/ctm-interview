<?php

use Faker\Generator as Faker;

$factory->define(App\Lead::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'opt' => $faker->boolean
    ];
});
