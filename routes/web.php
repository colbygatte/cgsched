<?php

Route::redirect('/', '/shifts');

Auth::routes();

Route::name('shifts.')->middleware('auth')->group(function () {
    Route::middleware('admin')->namespace('Admin')->group(function () {
        Route::name('edit')->get('/shifts/{shift}/edit', 'ShiftsController@edit');
        Route::name('store')->post('/shifts/{shift}/{user}', 'ShiftsController@store');
        Route::name('destroy')->delete('/shifts/{shift}/{user}', 'ShiftsController@destroy');
        Route::name('makeShift')->post('/makeShift/{definition}', 'ShiftsController@makeShift');
    });

    // Show the currently logged in user's shifts
    Route::name('index')->get('/shifts', 'ShiftsController@index');
});

Route::name('days.')->middleware('auth')->group(function () {
    Route::name('index')->get('/days', 'DaysController@index');
    Route::name('day')->get('/days/{date}', 'DaysController@show');
});
