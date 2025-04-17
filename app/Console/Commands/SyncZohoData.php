<?php

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
     * The name and signature of the console command.
     *
     * @var string
     */
        protected $signature = 'app:sync-zoho-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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
    }
}
