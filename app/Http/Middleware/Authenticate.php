<?php

/**
 * Authenticate Middleware
 *
 * This middleware is responsible for ensuring that the user is authenticated
 * before accessing certain routes. If the user is not authenticated, they will
 * be redirected to the login page or receive a JSON response if expecting it.
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }//end redirectTo()
}//end class
