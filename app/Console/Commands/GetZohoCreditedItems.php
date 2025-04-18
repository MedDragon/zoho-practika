<?php

/**
 * Команда для отримання зарахованих елементів з Zoho CRM.
 *
 * Цей клас виконує команду для запису інформації про виконання команди у файл.
 *
 * @package App\Console\Commands
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class GetZohoCreditedItems extends Command
{
    /**
     * Назва та підпис команди консолі.
     *
     * @var string
     */
    protected $signature = 'app:get-zoho-credited-items';

    /**
     * Опис команди.
     *
     * @var string
     */
    protected $description = 'Команда для запису інформації про зараховані елементи в Zoho CRM у файл.';

    /**
     * Виконання команди консолі.
     *
     * Цей метод виконує запис про успішне виконання команди в файл.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Command executed successfully.');
        $filePath = '/home/user/www/2024/zoho-practika/app/file/test.txt';
        file_put_contents($filePath, 'Command executed successfully. Current time: ' . Carbon::now() . PHP_EOL, FILE_APPEND);
    }//end handle()
}//end class
