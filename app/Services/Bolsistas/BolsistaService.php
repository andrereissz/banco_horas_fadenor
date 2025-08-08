<?php

namespace App\Services\Bolsistas;

use App\Models\Bolsista;
use App\Services\Interfaces\Bolsistas\BolsistaServiceInterface;
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

    public function register(array $data): Bolsista
    {
        return Bolsista::create([
            'password' => $data['password'],
            'nome' => $data['nome'],
            'data_nasc' => $data['data_nasc'],
            'nome_mae' => $data['nome_mae'],
            'nome_pai' => $data['nome_pai'],
            'sexo' => $data['sexo'],
            'estado_civil' => $data['estado_civil'],
            'raca_cor' => $data['raca_cor'],
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'escolaridade' => $data['escolaridade'],
            'est_pais' => $data['est_pais'] ?? null,
            'est_muni' => $data['est_muni'] ?? null,
            'muni_nasc' => $data['muni_nasc'],
            'uf_nasc' => $data['uf_nasc'],
            'cep' => $data['cep'],
            'muni_resid' => $data['muni_resid'],
            'uf_resid' => $data['uf_resid'],
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'],
            'bairro' => $data['bairro'],
            'cpf' => $data['cpf'],
            'pis' => $data['pis'],
            'rg' => $data['rg'],
            'rg_orgao' => $data['rg_orgao'],
            'rg_orgao_uf' => $data['rg_orgao_uf'],
            'rg_data_emissao' => $data['rg_data_emissao'],
            'titulo_eleitor' => $data['titulo_eleitor'],
            'titulo_zona' => $data['titulo_zona'],
            'titulo_secao' => $data['titulo_secao'],
            'certificado_reservista' => $data['certificado_reservista']
        ]);
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
