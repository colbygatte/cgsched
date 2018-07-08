<?php

namespace App\Http\Controllers;

use App\Day;
use App\Definition;
use App\Shift;
use App\UserRequest;

class DayController extends Controller
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
        $shifts = Shift::where('date', $date)->get();

        $definitionsMissing = Definition::whereNotIn('id', $shifts->pluck('definition_id'))->get();

        $shiftRequests = $shifts->filter(function ($shift) {
            return UserRequest::where([
                'user_id' => auth()->id(),
                'date' => $shift->date,
                'definition_id' => $shift->definition_id,
            ])->exists();
        })->pluck('id');

        $data = compact('shifts', 'definitionsMissing', 'date');

        return request()->wantsJson()
            ? $data
            : view('days.show', $data);
    }
}