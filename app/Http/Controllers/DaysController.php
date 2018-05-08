<?php

namespace App\Http\Controllers;

use App\Shift;

class DaysController extends Controller
{
    public function index()
    {
        $date = carb()->addDays(request('page', 0));

        $links = [
            ['url' => route('days.day', $date->toDateString()), 'date' => $date->toDateString()],
            ['url' => route('days.day', $date->addDay()->toDateString()), 'date' => $date->toDateString()],
            ['url' => route('days.day', $date->addDay()->toDateString()), 'date' => $date->toDateString()],
            ['url' => route('days.day', $date->addDay()->toDateString()), 'date' => $date->toDateString()],
            ['url' => route('days.day', $date->addDay()->toDateString()), 'date' => $date->toDateString()],
        ];

        return view('days.index', compact('links'));
    }

    public function show($date)
    {
        return view('days.show', [
            'shifts' => Shift::allForDate($date)
        ]);
    }
}