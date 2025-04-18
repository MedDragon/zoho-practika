<?php

/**
 * RedirectIfAuthenticated Middleware
 *
 * This middleware checks if the user is authenticated, and if so, redirects
 * them to the home route. If not authenticated, the request is passed to the
 * next middleware.
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * This method checks if the user is authenticated and if so, redirects them to the home page.
     *
     * @param  \Illuminate\Http\Request $request   The incoming request.
     * @param  \Closure                 $next      The next middleware to be executed.
     * @param  string                   ...$guards Guards for different types of authentication (optional).
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }//end handle()
}//end class
