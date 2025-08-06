<?php

namespace App\Http\Controllers\Bolsista\Auth;
use App\Services\bolsistas\Services\AuthBolsistaService;
use Illuminate\Http\Request;

class LogoutController
{
    public function __construct(protected AuthBolsistaService $authService){}

    public function __invoke(Request $request)
    {
        $this->authService->logout($request);
        return redirect('/');
    }
}
