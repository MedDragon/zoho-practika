<?php

namespace App\Console\Commands;

// tak delat nizzya!
class AllClients
{
    public function handle()
    {
        $search = ZohoCrmApi::getInstance()
            ->setModule('Accounts')
            ->records()
            ->getRecords()
            ->request();
        dump($search);
    }
}
