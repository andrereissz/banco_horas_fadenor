<?php

namespace App\Providers\Services\Bolsista;

use App\Services\BolsistaService;
use App\Services\BolsistaServiceInterface;
use Illuminate\Support\ServiceProvider;

class BolsistaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BolsistaServiceInterface::class, function ($app) {
            return new BolsistaService();
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
