<?php

/**
 * DomPdf Controller
 *
 * This controller is responsible for generating a PDF document with the provided
 * deal data and attaching it to a Zoho CRM account.
 *
 * @package App\Http\Controllers
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use ZohoCrmSDK\Api\ZohoCrmApi;

class DomPdfController extends Controller
{
    /**
     * Generates a PDF document with the provided deal data and attaches it to
     * a Zoho CRM account.
     *
     * @param array $data An array containing information about the deals.
     * @return string The file path to the saved PDF file.
     */
    public function createPDF(array $data): string
    {
        // Generate PDF from deal data.
        $filePath = storage_path('app/public/invoice.pdf');
        $pdf = Pdf::loadView('deal-pdf', ['data' => $data]);
        $pdf->save($filePath);

        // Get the account ID from the deal data.
        $accID = $data[0]['deal']['Account_Name']['id'];

        // Upload the generated PDF as an attachment to the account in Zoho CRM.
        $attachments = ZohoCrmApi::getInstance()
            ->setModule('Accounts')
            ->records()
            ->uploadAttachment($accID, $filePath)
            ->request();

        // Return the file path to the saved PDF.
        return $filePath;
    }//end createPDF()
}//end class
