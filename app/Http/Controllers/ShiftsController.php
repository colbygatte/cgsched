<?php

namespace App\Http\Controllers;

use App\Definition;
use App\Shift;
use App\User;
use App\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Auth::user()->shifts()->orderBy('date', 'asc')->paginate(25);

        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shift $shift
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return view('shifts.edit', [
            'shift' => $shift,
            'usersOnShift' => $shift->users,
            'usersNotOnShift' => User::whereNotIn('id', $shift->users->map->id)->get(),
            'usersRequestingOff' => UserRequest::forDate($shift->date)->forDefinition($shift->definition_id)->get()->map->user_id
        ]);
    }

    public function store(Shift $shift, User $user)
    {
        $shift->users()->attach($user);

        return back()->with(['status' => 'Successfully added']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Shift               $shift
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**c
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift $shift
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift, User $user)
    {
        $shift->users()->detach($user);

        return back()->with(['status' => 'Successfully removed']);
    }

    public function makeShift(Definition $definition)
    {
        $date = carb(request('date'));

        Shift::create([
            'date' => $date,
            'definition_id' => $definition->id
        ]);

        return back()->with(['status' => 'Success!']);
    }
}

