<?php

namespace App;

class Day
{
    static public function links($date = null, $perPage = 20)
    {
        $date = carb($date);

        return [
            'nextUrl' => route('days.index', [
                'start' => $date->copy()->addDays($perPage)->toDateString()
            ]),
            'previousUrl' => route('days.index', [
                'start' => $date->copy()->subDays($perPage)->toDateString()
            ]),
            'links' => collect(static::range($date, $perPage))->map(function ($date) {
                return ['date' => $date, 'url' => route('days.day', $date),];
            })
        ];
    }

    public static function range($date = null, $amount = 20)
    {
        $date = carb($date);

        // Subtract a single day before loop.
        $date->subDay();

        $dates = [];

        for ($i = 0; $i < $amount; $i++) {
            $dates[] = $date->addDay()->toDateString();
        }

        return $dates;
    }
}