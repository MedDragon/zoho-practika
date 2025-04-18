<?php

/**
 * PreventRequestsDuringMaintenance Middleware
 *
 * This middleware ensures that requests to the application are prevented during
 * maintenance mode unless they are part of the specified URIs that are allowed.
 *
 * @package App\Http\Middleware
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Specify URIs to allow during maintenance mode, for example:
        // 'health-check',
    ];
}//end class
