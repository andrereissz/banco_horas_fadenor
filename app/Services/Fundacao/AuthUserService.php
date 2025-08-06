<?php

namespace App\Services\fundacao\Services;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthUserService implements AuthServiceInterface
{
    public function login(array $credentials, bool $remember): bool
    {
        return Auth::guard('fundacao')->attempt($credentials, $remember);
    }

    public function logout(Request $request): void
    {
        Auth::guard('fundacao')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function sendResetLink(array $credentials): string
    {
        return Password::broker('users')->sendResetLink($credentials);
    }
}
