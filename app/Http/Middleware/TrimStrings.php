<?php

/**
 * TrimStrings Middleware
 *
 * This middleware trims the white spaces from the input attributes except for those specified
 * in the `$except` array.
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}//end class
