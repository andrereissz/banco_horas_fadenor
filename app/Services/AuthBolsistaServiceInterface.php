<?php

namespace App\Services;

use App\Models\Bolsista;

interface AuthBolsistaServiceInterface
{
    public function register(array $data): Bolsista;
    public function login(array $credentials): bool;
    public function logout(): void;
}
