<?php

namespace App\Http\Middleware;

use App\Exceptions\WrongPermissionsException;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! auth()->isAdmin()) {
            throw new WrongPermissionsException();
        }

        return $next($request);
    }
}
