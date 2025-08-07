<?php

namespace App\Providers\Services\Bolsistas;

use App\Services\Bolsistas\BolsistaService;
use App\Services\Interfaces\Bolsistas\BolsistaServiceInterface;
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
