<?php

namespace App\Services\Interfaces\ViaCep;

interface ViaCepServiceInterface
{
    public function buscar(string $cep): ?array;
}
