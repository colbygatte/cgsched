<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return Announcement::paginate(config('cgsched.pagination.per_page'));
    }

    public function show(Announcement $announcement)
    {
        return $announcement;
    }

    public function store(Request $request)
    {
        return [
            'message' => 'Success',
            'data' => Announcement::create($request->validate([
                'title' => 'required|string',
                'body' => 'required|string',
                'pinned' => 'boolean'
            ]))
        ];
    }

    public function update(Announcement $announcement, Request $request)
    {
        $announcement->update($request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'pinned' => 'boolean'
        ]));

        return ['message' => 'Success'];
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return ['message' => 'Success'];
    }
}