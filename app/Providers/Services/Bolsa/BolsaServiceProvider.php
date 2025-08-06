<?php

namespace App\Providers\Services\Bolsa;

use App\Services\bolsas\Interfaces\BolsaServiceInterface;
use App\Services\bolsas\Services\BolsaService;
use Illuminate\Support\ServiceProvider;

class BolsaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BolsaServiceInterface::class, function ($app) {
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
