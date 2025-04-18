<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

/**
 * Контролер для роботи з обліковими записами
 *
 * Цей контролер відповідає за отримання списку облікових записів
 * з Zoho CRM за допомогою API та передачу даних у відповідне подання.
 *
 * @package App\Http\Controllers
 */

class AccountController extends Controller
{
    /**
     * Отримує список облікових записів із Zoho CRM та повертає подання
     *
     * @return \Illuminate\Contracts\View\View подання зі списком облікових записів
     */

    public function index()
    {
        $account = new Account();
        $response = $account->request('GET', 'https://your-zoho-api-endpoint', [
            'headers' => [
                'Authorization' => 'Bearer ' . 'your_access_token',
            ],
        ]);

        $accounts = json_decode($response->getBody()->getContents(), true);

        return view('accounts.index', ['accounts' => $accounts['data']]);
    }
}
