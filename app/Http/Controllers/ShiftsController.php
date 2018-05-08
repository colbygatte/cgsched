<?php

namespace App\Http\Controllers;

use App\Shift;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
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
        $shifts = Auth::user()->shifts()->paginate(25);

        return view('shifts.index', compact('shifts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shift $shift
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        return view('shifts.show', compact('shift'));
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
        return view('shifts.edit', compact('shift'));
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
}

