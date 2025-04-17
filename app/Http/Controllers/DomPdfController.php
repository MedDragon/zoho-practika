<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use ZohoCrmSDK\Api\ZohoCrmApi;

class DomPdfController extends Controller
{
    public function createPDF($data): string
    {
//        о print_r($data);
        $filePath = storage_path('app/public/invoice.pdf');
        $pdf = Pdf::loadView('deal-pdf', ['data' => $data]);
        $pdf->save($filePath);

        $accID = $data[0]['deal']['Account_Name']['id'];

        $attachments = ZohoCrmApi::getInstance()
            ->setModule('Accounts')
            ->records()
            ->uploadAttachment($accID, $filePath)
            ->request();



//        return $pdf->save('invoice.pdf');
        return $filePath;
    }
}
