<?php

namespace App\Services;

use App\Models\Bolsa;
use Illuminate\Database\Eloquent\Collection;

interface BolsaServiceInterface
{
    public function get(): Collection;
    public function find(string $uuid): ?Bolsa;
    public function findBolsaByToken(string $token): ?Bolsa;
    public function create(array $data): Bolsa;
    public function update(Bolsa $bolsa, array $data): bool;
    public function delete(Bolsa $bolsa): bool;
    public function solicitar(array $data): Bolsa;
    public function registrar(string $token,array $data, array $files): Bolsa;
    public function updateStatus(Bolsa $bolsa, int $newStatus);
}
