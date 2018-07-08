<?php

namespace App;

use Illuminate\Support\Collection;

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
            'links' => static::range($date, $perPage)->map(function ($date) {
                return ['date' => $date, 'url' => route('days.show', $date),];
            })
        ];
    }

    public static function range($date = null, $amount = 20)
    {
        // Subtract a single day. A day is added in each loop below.
        $date = carb($date)->subDay();

        return Collection::times($amount, function () use ($date) {
            return $date->addDay()->toDateString();
        });
    }
}