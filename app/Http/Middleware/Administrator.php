<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\WrongPermissionsException;
use Illuminate\Contracts\Auth\Factory as Auth;

class Administrator
{
    /**
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

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
