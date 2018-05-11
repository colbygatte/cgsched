<?php

use Faker\Generator as Faker;

$factory->define(App\UserRequest::class, function (Faker $faker) {
    return [
        'definition_id' => function () {
            return factory(App\Definition::class)->create()->id;
        },
        'date' => function () use ($faker) {
            return today()->addDays($faker->numberBetween(0, 10));
        },
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
