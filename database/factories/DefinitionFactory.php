<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$factory->define(App\Definition::class, function (Faker $faker) {
    return [
        'name' => function () {
            static $shiftNames = ['Morning', 'Night', 'Afternoon', 'Early Bird', 'Graveyard'];
            static $unused = [];

            if (empty($unused)) {
                $unused = $shiftNames;
            }

            $value = $unused[$randKey = array_rand($unused)];

            unset($unused[$randKey]);

            return $value;
        },
        'start_time' => function () {
            return now()->setTime(
                Arr::random(range(0, 24)),
                Arr::random([0, 30]),
                0
            );
        },
        'end_time' => function ($args) {
            return Carbon::parse(
                (string) $args['start_time']
            )->addHours(
                Arr::random([4, 5, 6])
            )->addMinutes(
                Arr::random([0, 30])
            );
        }
    ];
});
