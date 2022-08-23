<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
<<<<<<< HEAD
        if (!$request->expectsJson()) {
            return route('auth.login.create');
=======
        if (! $request->expectsJson()) {
            return route('login');
>>>>>>> a875b7d438a38c2e34c4db4d1c2a95929cdcf116
        }
    }
}
