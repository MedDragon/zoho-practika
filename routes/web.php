<?php

/**
 * Web routes for the application.
 *
 * These routes are loaded by the RouteServiceProvider within a group
 * which contains the "web" middleware group.
 */

use Illuminate\Support\Facades\Route;
use ZohoCrmSDK\Api\ZohoCrmApi;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $search = ZohoCrmApi::getInstance()
        ->setModule('Accounts')
        ->records()
        ->getRecords()
        ->request();
    dump($search);

    return view('welcome');
});

Route::get('btn', function () {
    return view('btn');
});

Route::post('handle-webhook', [WebhookController::class, 'handleWebhook']);

Route::get('deal-pdf', function () {
    return view('deal-pdf');
});
