<?php

use Faker\Generator as Faker;

$factory->define(App\Store::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'code' => $faker->numberBetween(10000, 99999),
    ];
});
