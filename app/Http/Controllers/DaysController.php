<?php

namespace App\Http\Controllers;

use App\Day;
use App\Definition;
use App\Shift;
use App\UserRequest;

class DaysController extends Controller
{
    /**
     * Paginated list of all days.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $linkData = Day::links(request('start'), 20);

        return view('days.index', $linkData);
    }

    /**
     * Show the shifts for a particular day.
     *
     * @param $date
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($date)
    {
        $shifts = Shift::forDate($date)->get();

        $definitionsMissing = Definition::allExcept($shifts->pluck('definition_id'))->get();

        $shiftRequests = $shifts->filter(function($shift) {
            return UserRequest::where('user_id', auth()->id())
                ->forDate($shift->date)
                ->forDefinition($shift->definition_id)
                ->exists();
        })->pluck('id');

        return view('days.show', compact('shifts', 'definitionsMissing', 'date'));
    }
}