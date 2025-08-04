<?php

namespace App\Services;

use App\Models\Bolsista;
use App\Services\BolsistaServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class BolsistaService implements BolsistaServiceInterface
{
    public function get(): Collection
    {
        return Bolsista::all();
    }

    public function find(string $cpf): ?Bolsista
    {
        return Bolsista::where('cpf', $cpf)->first();
    }

    public function update(Bolsista $Bolsista, array $data): bool
    {
        return $Bolsista->update($data);
    }

    public function delete(Bolsista $Bolsista): bool
    {
        return $Bolsista->delete();
    }
}
