<?php

namespace App\Services\bolsistas\Interfaces;

use App\Models\Bolsista;
use Illuminate\Database\Eloquent\Collection;

interface BolsistaServiceInterface
{
    public function get(): Collection;

    public function find(string $cpf): ?Bolsista;

    public function update(Bolsista $Bolsista, array $data): bool;

    public function delete(Bolsista $Bolsista): bool;
}
