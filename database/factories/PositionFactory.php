<?php

use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Position::class, function (Faker $faker) {
    return [
        'name' => Arr::random(['Cook', 'Steam table', 'Cashier', 'Host', 'Waiter', 'Busser'])
    ];
});
