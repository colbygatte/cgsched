<?php

use Faker\Generator as Faker;

$factory->define(App\Shift::class, function (Faker $faker) {
    return [
        'definition_id' => function () {
            return factory(App\Definition::class)->create()->id;
        },
        'date' => function () use ($faker) {
            return today()->addDays($faker->numberBetween(0, 10));
        },
    ];
});
