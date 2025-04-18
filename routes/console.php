<?php

/**
 * Console routes for the application.
 *
 * This file defines Closure-based console commands that are bound
 * to a command instance, allowing interaction with each command's IO methods.
 */

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
    |--------------------------------------------------------------------------
    | Console Routes
    |--------------------------------------------------------------------------
    |
    | This file is where you may define all of your Closure based console
    | commands. Each Closure is bound to a command instance allowing a
    | simple approach to interacting with each command's IO methods.
    |
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
