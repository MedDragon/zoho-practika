<?php

namespace App\Manager;

class ZohoDataManager
{
    public static function formatDataForDB(array $data): array
    {
        return [
            'zohoID' => $data['id'],
            'First_Name' => $data['First_Name'] ?? '',
            'Last_Name' => $data['Last_Name'] ?? '',
            'Email' => $data['Email'] ?? '',
            'Mobile' => $data['Mobile'] ?? '',
            'Account_Name' => json_encode($data['Account_Name']) ?? '',
        ];
    }

    public static function DealsformatDataForDB(array $data): array
    {
        return [
            'zoho_deal_id' => $data['id'],
            'Account_Name' => json_encode($data['Account_Name']) ?? '',
            'Deal_Name' => $data['Deal_Name'] ?? '',
            'Stage' => $data['Stage'] ?? '',
            'Closing_Date' => $data['Closing_Date'] ?? '',
            'Amount' => $data['Amount'] ?? '',
            'Contact_Name' => json_encode($data['Contact_Name']) ?? '',
        ];
    }
}
