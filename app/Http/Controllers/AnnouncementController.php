<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::paginate(config('cgsched.pagination.per_page'));

        return request()->wantsJson()
            ? $announcements
            : view('announcements.index', compact('announcements'));
    }
}
