<?php

namespace App\Providers;

use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            return auth()->isAdmin();
        });

        SessionGuard::macro('isAdmin', function () {
            return optional(auth()->user())->isAdmin() ?? false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
