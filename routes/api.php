<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Admin API routes
    Route::middleware('admin')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::apiResource('announcements', 'AnnouncementController');
        Route::apiResource('users', 'UserController')->only(['index', 'show']);
    });
});
