<?php

/**
 * AppServiceProvider
 *
 * This service provider is used to register any application services
 * and bootstrap any application services.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register any application services here.
    }//end register()

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Bootstrap any application services here.
    }//end boot()
}//end class
