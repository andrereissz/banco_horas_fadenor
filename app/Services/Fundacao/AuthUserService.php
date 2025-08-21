<?php

namespace App\Services\Fundacao;

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

    public function sendResetLink(string $email): string
    {
        return Password::broker('users')->sendResetLink(['email' => $email]);
    }

    public function resetPassword(array $data): string
    {
        return Password::broker('users')->reset($data, function ($user, $password) {
            $user->forceFill([
                'password' => $password,
            ])->save();
        });
    }
}
