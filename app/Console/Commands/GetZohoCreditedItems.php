<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class GetZohoCreditedItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-zoho-credited-items';

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
        $this->info('Command executed successfully.');
        $filePath = '/home/user/www/2024/zoho-practika/app/file/test.txt';
        file_put_contents($filePath, 'Command executed successfully. Current time: ' . Carbon::now() . PHP_EOL, FILE_APPEND);
    }
}
