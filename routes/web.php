<?php

Route::redirect('/', '/shifts');

Auth::routes();

Route::match(['get', 'post'], '/test', function () {
    return [
        'get' => request()->query->all(),
        'post' => request()->request->all(),
        'body' => request()->getContent(),
        'headers' => collect(request()->headers)->all(),
    ];
});

Route::name('shifts.')->middleware('auth')->group(function () {
    Route::middleware('admin')->namespace('Admin')->group(function () {
        Route::name('edit')->get('/shifts/{shift}/edit', 'ShiftController@edit');
        Route::name('store')->post('/shifts/{shift}/{user}', 'ShiftController@store');
        Route::name('destroy')->delete('/shifts/{shift}/{user}', 'ShiftController@destroy');
        Route::name('makeShift')->post('/makeShift/{definition}', 'ShiftController@makeShift');
    });

    // Show the currently logged in user's shifts
    Route::name('index')->get('/shifts', 'ShiftController@index');
});

Route::name('days.')->middleware('auth')->group(function () {
    Route::name('index')->get('/days', 'DayController@index');
    Route::name('show')->get('/days/{date}', 'DayController@show');
});
