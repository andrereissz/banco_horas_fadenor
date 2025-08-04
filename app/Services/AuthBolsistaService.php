<?php

namespace App\Services;

use App\Models\Bolsista;

class AuthBolsistaService implements AuthBolsistaServiceInterface
{
    public function register(array $data): Bolsista
    {
    }

    public function login(array $credentials): bool
    {
    }

    public function logout(): void
    {
    }
}
