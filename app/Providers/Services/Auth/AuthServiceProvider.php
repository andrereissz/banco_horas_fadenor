<?php

namespace App\Providers\Services\Auth;

use App\Services\Bolsistas\AuthBolsistaService;
use App\Services\Fundacao\AuthUserService;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, function ($app) {
            $request = $app->make(Request::class);
            $refererUrl = $request->headers->get('referer');
            if ($request->routeIs('bolsistas.login') || $request->routeIs('bolsistas.logout') || ($refererUrl && Str::contains($refererUrl, '/bolsistas'))) {
                return new AuthBolsistaService;
            }

            if ($request->routeIs('fundacao.login') || $request->routeIs('fundacao.logout') || ($refererUrl && Str::contains($refererUrl, '/fundacao'))) {
                return new AuthUserService;
            }
        });
    }

    public function boot()
    {
        //
    }
}
