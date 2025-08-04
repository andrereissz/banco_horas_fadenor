<?php

namespace App\Providers;

use App\Services\BolsaService;
use App\Services\BolsistaServiceInterface;
use Illuminate\Support\ServiceProvider;

class BolsaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BolsistaServiceInterface::class, function ($app) {
            return new BolsaService();
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
