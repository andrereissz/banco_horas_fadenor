<?php

namespace App\Services;

use App\Models\Bolsa;
use Illuminate\Database\Eloquent\Collection;

interface BolsaServiceInterface
{
    public function get(): Collection;
    public function find(string $uuid): ?Bolsa;
    public function create(array $data): Bolsa;
    public function update(Bolsa $Bolsa, array $data): bool;
    public function delete(Bolsa $Bolsa): bool;
    public function solicitar(array $data, array $files): Bolsa;
    public function registrar(array $data, array $files): Bolsa;
    public function updateStatus(Bolsa $Bolsa, int $newStatus);
}
