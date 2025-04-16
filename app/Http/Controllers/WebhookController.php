<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZohoCrmSDK\Api\ZohoCrmApi;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Отримуємо всі дані з запиту
        $dealsId = $request->input('deals');

        // Для зберігання даних про угоди
        $dealsData = [];

        // Проходимо по кожному ідентифікатору угоди та отримуємо дані
        foreach ($dealsId as $dealId) {
            $deal = ZohoCrmApi::getInstance()
                ->setModule('Deals')
                ->records()
                ->getRecordById($dealId)
                ->request();

            // Додаємо дані про угоду в масив
            $dealsData[] = [
                'id' => $dealId,
                'deal' => $deal,
            ];
        }

        (new DomPdfController())->createPDF($dealsData);
        // Повертаємо всі дані про угоди у відповіді
        return response()->json([
            'status' => '200',
        ]);
    }

}
