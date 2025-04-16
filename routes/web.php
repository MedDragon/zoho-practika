<?php

use Illuminate\Support\Facades\Route;
use ZohoCrmSDK\Api\ZohoCrmApi;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
