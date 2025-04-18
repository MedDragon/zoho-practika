<?php

/**
 * VerifyCsrfToken Middleware
 *
 * This middleware is responsible for verifying the CSRF token for incoming requests.
 * It includes an exception for certain URIs that should be excluded from CSRF verification.
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'handle-webhook',
    ];
}//end class
