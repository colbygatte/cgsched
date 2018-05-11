<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Definition::class, function (Faker $faker) {
    return [
        'name' => function () {
            $shift = Arr::random(['Morning', 'Night', 'Afternoon', 'Early Bird', 'Graveyard']);
            $position = Arr::random(['Cook', 'Steam table', 'Cashier', 'Host', 'Waiter', 'Busser']);

            return "$shift - $position";
        },
        'start_time' => function () {
            return now()->setTime(
                Arr::random(range(0, 24)),
                Arr::random([0, 30]),
                0
            );
        },
        'end_time' => function ($args) {
            return Carbon::parse((string) $args['start_time'])
                ->addHours(Arr::random([4, 5, 6]))
                ->addMinutes(Arr::random([0, 30]));
        }
    ];
});
