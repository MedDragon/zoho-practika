<?php

/**
 * API routes for the application.
 *
 * This file defines routes that are loaded by the RouteServiceProvider and
 * assigned to the "api" middleware group.
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
