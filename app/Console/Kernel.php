<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//         $schedule->command('inspire')->hourly();
//         $schedule->command('get-zoho-crediteditems:run')->hourlyAt(45);
//         $schedule->command('app:get-zoho-credited-items:run')->everyMinute();
//        $schedule->command('app:get-zoho-credited-items')->hourlyAt(45);
        $schedule->command('app:sync-zoho-data')->everyMinute();


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');

        Commands\GetZohoCreditedItems::class;
    }
}
