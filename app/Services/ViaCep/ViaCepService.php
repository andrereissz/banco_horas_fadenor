<?php

namespace App\Services\ViaCep;

use App\Services\Interfaces\ViaCep\ViaCepServiceInterface;
use Illuminate\Support\Facades\Http;

class ViaCepService implements ViaCepServiceInterface
{
    public function __construct(
        protected int $timeout = 10
    ) {}

    public function buscar(string $cep): ?array
    {
        $cep = $this->onlyDigits($cep);
        if (strlen($cep) !== 8) {
            return null;
        }

        $resp = Http::timeout($this->timeout)
            ->acceptJson()
            ->get("https://viacep.com.br/ws/{$cep}/json/");

        if ($resp->failed() || $resp->json('erro') === true) {
            return null;
        }

        $j = $resp->json();

        return [
            'cep'         => $this->formatCep($cep),
            'logradouro'  => $j['logradouro']  ?? '',
            'bairro'      => $j['bairro']      ?? '',
            'localidade'  => $j['localidade']  ?? '',
            'uf'          => $j['uf']          ?? '',
            'complemento' => $j['complemento'] ?? '',
        ];
    }

    private function onlyDigits(string $v): string
    {
        return preg_replace('/\D/', '', $v) ?? '';
    }

    private function formatCep(string $cep): string
    {
        return substr($cep, 0, 5) . '-' . substr($cep, 5);
    }
}
