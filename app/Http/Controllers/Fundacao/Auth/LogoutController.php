<?php

namespace App\Http\Controllers\Fundacao\Auth;
use App\Services\fundacao\Services\AuthUserService;
use Illuminate\Http\Request;

class LogoutController
{
    public function __construct(protected AuthUserService $authService){}

    public function __invoke(Request $request)
    {
        $this->authService->logout($request);
        return redirect('/');
    }
}
