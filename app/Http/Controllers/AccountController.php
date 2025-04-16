<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AccountController extends Controller
{
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
