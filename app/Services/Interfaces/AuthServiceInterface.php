<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function login(array $credentials, bool $remember): bool;
    public function logout(Request $request): void;
    public function sendResetLink(array $credentials): string;
    public function resetPassword(array $data): string;
}
