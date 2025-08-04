<?php

namespace App\Providers;

use App\Services\BolsaServiceInterface;
use Illuminate\Support\ServiceProvider;

class BolsaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BolsaServiceInterface::class, function ($app) {
            return new \App\Services\BolsaService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
