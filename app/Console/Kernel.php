<?php

/**
 * Консольний ядро для застосунку
 *
 * Цей клас відповідає за планування команд та реєстрацію команд у застосунку.
 *
 * @package App\Console
 */

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * Цей метод визначає графік виконання команд.
     *
     * @param Schedule $schedule Планувальник команд.
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('get-zoho-crediteditems:run')->hourlyAt(45);
        // $schedule->command('app:get-zoho-credited-items:run')->everyMinute();
        // $schedule->command('app:get-zoho-credited-items')->hourlyAt(45);
        $schedule->command('app:sync-zoho-data')->everyMinute();
    }//end schedule()

    /**
     * Register the commands for the application.
     *
     * Цей метод реєструє команди для застосунку.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');

        Commands\GetZohoCreditedItems::class;
    }//end commands()
}//end class
