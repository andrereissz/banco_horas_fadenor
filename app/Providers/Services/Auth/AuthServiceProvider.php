<?php

namespace App\Providers\Services\Auth;

use App\Services\Bolsistas\AuthBolsistaService;
use App\Services\Fundacao\AuthUserService;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, function ($app) {
            $request = $app->make('request');
            if($request->is('fundacao/*')) {
                return new AuthUserService();
            }
            else if($request->is('bolsistas/*')) {
                return new AuthBolsistaService();
            }
        });
    }

    public function boot()
    {
        //
    }
}
