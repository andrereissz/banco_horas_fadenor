<?php

namespace App\Providers\Services\Bolsa;

use App\Services\Interfaces\Bolsas\BolsaServiceInterface;
use App\Services\Bolsas\BolsaService;
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
