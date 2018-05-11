<?php

namespace App\Http\Controllers;

use App\Day;
use App\Definition;
use App\Shift;

class DaysController extends Controller
{
    public function index()
    {
        $linkData = Day::links(request('start'), 20);

        return view('days.index', $linkData);
    }

    public function show($date)
    {
        $shifts = Shift::forDate($date)->get();

        $definitionsMissing = Definition::allExcept($shifts->map->definition_id)->get();

        return view('days.show', compact('shifts', 'definitionsMissing', 'date'));
    }
}