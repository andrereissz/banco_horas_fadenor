<?php

namespace App\Services\bolsistas\Interfaces;

use App\Models\Bolsista;

interface AuthBolsistaServiceInterface
{
    public function register(array $data): Bolsista;
    public function login(array $credentials, bool $remember): bool;
    public function logout(): void;
}
