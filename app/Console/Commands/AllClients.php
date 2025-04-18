<?php

/**
 * Клас для обробки команд консольного інтерфейсу для взаємодії з API Zoho CRM.
 *
 * Цей клас відповідає за отримання записів зі специфічного модуля API Zoho CRM, зокрема записів клієнтів з модуля "Accounts".
 *
 * @package App\Console\Commands
 */

namespace App\Console\Commands;

use ZohoCrmSDK\Api\ZohoCrmApi;

/**
 * Клас для отримання всіх клієнтів з модуля "Accounts" через API Zoho CRM.
 */
class AllClients
{
    /**
     * Обробка команд консольного інтерфейсу.
     *
     * Цей метод відповідає за отримання всіх клієнтів з модуля "Accounts" за допомогою API.
     *
     * @return void
     */
    public function handle(): void
    {
        $search = ZohoCrmApi::getInstance()
            ->setModule('Accounts')
            ->records()
            ->getRecords()
            ->request();

        dump($search);
    }//end handle()
}//end class
