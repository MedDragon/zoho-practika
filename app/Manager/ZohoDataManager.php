<?php

/**
 * ZohoDataManager Class
 *
 * This class provides methods for formatting data before saving it to the database.
 * It includes methods for dealing with both individual Zoho data and deal-related data.
 */

namespace App\Manager;

class ZohoDataManager
{
    /**
     * Format the Zoho data for saving to the database.
     *
     * @param array $data
     * @return array
     */
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
    }//end formatDataForDB()

    /**
     * Format the deal data for saving to the database.
     *
     * @param array $data
     * @return array
     */
    public static function formatDealsDataForDB(array $data): array
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
    }//end formatDealsDataForDB()
}//end class
