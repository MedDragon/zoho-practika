<?php

/**
 * EncryptCookies Middleware
 *
 * This middleware ensures that cookies are encrypted before being sent to the client
 * and decrypts cookies for requests coming back from the client.
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Specify cookies that should not be encrypted here, for example:
        // 'user_preferences',
    ];
}//end class
