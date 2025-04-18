<?php

/**
 * Команда для синхронізації даних з Zoho CRM.
 *
 * Цей клас відповідає за отримання даних з Zoho CRM (контакти та угоди)
 * і збереження їх у базі даних.
 *
 * @package App\Console\Commands
 */

namespace App\Console\Commands;

use App\Models\DataDeals;
use App\Manager\ZohoDataManager;
use Illuminate\Console\Command;
use ZohoCrmSDK\Api\ZohoCrmApi;
use App\Models\zohoData;
use Carbon\Carbon;

class SyncZohoData extends Command
{
    /**
     * Назва та підпис команди консолі.
     *
     * @var string
     */
    protected $signature = 'app:sync-zoho-data';

    /**
     * Опис команди.
     *
     * @var string
     */
    protected $description = 'Синхронізація даних з Zoho CRM для контактів та угод.';

    /**
     * Виконання команди консолі.
     *
     * Цей метод отримує оновлені контакти та угоди з Zoho CRM
     * і зберігає їх у базі даних.
     *
     * @return void
     */
    public function handle(): void
    {
        $zohoContacts = ZohoCrmApi::getInstance()
            ->setModule('Contacts')
            ->records()
            ->getRecords()
            ->modifiedAfter(now()->subHours(1))
            ->request();

        foreach ($zohoContacts as $contactData) {
            (new zohoData())->pushToDB($contactData);
        }

        $zohoDeals = ZohoCrmApi::getInstance()
            ->setModule('Deals')
            ->records()
            ->getRecords()
            ->modifiedAfter(now()->subHours(1))
            ->request();

        foreach ($zohoDeals as $dealData) {
            (new DataDeals())->pushToDB($dealData);
        }
    }//end handle()
}//end class
