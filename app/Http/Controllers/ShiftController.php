<?php

namespace App\Http\Controllers;

use App\Definition;
use App\Shift;
use App\User;
use App\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Auth::user()->shifts()->orderBy('date', 'asc')->paginate(config('cgsched.pagination.per_page'));

        return view('shifts.index', compact('shifts'));
    }
}

