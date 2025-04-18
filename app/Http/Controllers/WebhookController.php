<?php

/**
 * Webhook Controller
 *
 * This controller handles incoming webhook requests from Zoho CRM and generates
 * PDF documents with deal information.
 *
 * @package App\Http\Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZohoCrmSDK\Api\ZohoCrmApi;

class WebhookController extends Controller
{
    /**
     * Handles the incoming webhook request from Zoho CRM and generates a PDF
     * with the deal information.
     *
     * @param Request $request The incoming request containing an array of deal identifiers.
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleWebhook(Request $request)
    {
        // Retrieve all the data from the request.
        $dealsId = $request->input('deals');

        // Initialize an array to store the deal data.
        $dealsData = [];

        // Loop through each deal ID and retrieve the deal data.
        foreach ($dealsId as $dealId) {
            $deal = ZohoCrmApi::getInstance()
                ->setModule('Deals')
                ->records()
                ->getRecordById($dealId)
                ->request();

            // Add the deal data to the array.
            $dealsData[] = [
                'id' => $dealId,
                'deal' => $deal,
            ];
        }

        // Create the PDF document with the deal data.
        (new DomPdfController())->createPDF($dealsData);

        // Return the deal data in the response.
        return response()->json([
            'status' => '200',
        ]);
    }//end handleWebhook()
}//end class
