<?php

namespace App\Providers\Services\Bolsista\Auth;

use App\Services\AuthBolsistaService;
use App\Services\AuthBolsistaServiceInterface;
use Illuminate\Support\ServiceProvider;

class AuthBolsistaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthBolsistaServiceInterface::class, function ($app) {
            return new AuthBolsistaService();
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
