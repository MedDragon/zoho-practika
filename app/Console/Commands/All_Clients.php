<?php

namespace App\Console\Commands;

// tak delat nizzya!
class All_Clients
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
