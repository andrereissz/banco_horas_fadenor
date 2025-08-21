<?php

namespace App\Providers;

use App\Services\Interfaces\ViaCep\ViaCepServiceInterface;
use App\Services\ViaCep\ViaCepService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->bind(ViaCepServiceInterface::class, function ($app) {
            return new ViaCepService;
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
