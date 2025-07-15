<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Littleboy130491\Sumimasen\Settings\GeneralSettings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('settings', function ($app) {
            return $app->make(GeneralSettings::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }


}
