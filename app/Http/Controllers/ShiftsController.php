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
}

