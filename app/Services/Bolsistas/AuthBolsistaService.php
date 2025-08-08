<?php

namespace App\Services\Bolsistas;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthBolsistaService implements AuthServiceInterface
{
    public function login(array $credentials, bool $remember): bool
    {
        return Auth::guard('bolsistas')->attempt($credentials, $remember);
    }

    public function logout(Request $request): void
    {
        Auth::guard('bolsistas')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function sendResetLink(string $email): string
    {
        return Password::broker('bolsistas')->sendResetLink(['email' => $email]);
    }

    public function resetPassword(array $data): string
    {
        return Password::broker('bolsistas')->reset($data, function ($user, $password) {
            $user->forceFill([
                'password' => $password,
            ])->save();
        });
    }
}
