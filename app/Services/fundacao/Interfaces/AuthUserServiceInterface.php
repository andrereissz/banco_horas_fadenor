<?php

namespace App\Services\fundacao\Interfaces;

use Illuminate\Http\Request;

interface AuthUserServiceInterface
{
    public function login(array $credentials, bool $remember): bool;
    public function logout(Request $request): void;
    public function sendResetLink(array $credentials): string;
}
