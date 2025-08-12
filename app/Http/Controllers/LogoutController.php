<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;

class LogoutController
{
    public function __construct(protected AuthServiceInterface $authService) {}

    public function destroy(Request $request)
    {
        $this->authService->logout($request);

        return redirect('/');
    }
}
