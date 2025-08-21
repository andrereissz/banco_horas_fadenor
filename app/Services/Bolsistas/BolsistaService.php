<?php

namespace App\Services\Bolsistas;

use App\Models\Bolsista;
use App\Services\Interfaces\Bolsistas\BolsistaServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class BolsistaService implements BolsistaServiceInterface
{
    public function get(): Collection
    {
        return Bolsista::all();
    }

    public function find(string $cpf): ?Bolsista
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        return Bolsista::where('cpf', $cpf)->first();
    }

    public function create(array $data): Bolsista
    {
        return Bolsista::create([
            'password' => $data['password'],
            'nome' => $this->formataText($data['nome']),
            'data_nasc' => $data['dataNasc'],
            'nome_mae' => $this->formataText($data['nomeMae']),
            'nome_pai' => $this->formataText($data['nomePai']),
            'sexo' => $data['sexo'],
            'estado_civil' => $data['estadoCivil'],
            'raca_cor' => $data['racaCor'],
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'escolaridade' => $data['escolaridade'],
            'est_pais' => $data['estPais'] ?? null,
            'muni_nasc' => $data['muniNasc'],
            'uf_nasc' => $data['ufNasc'],
            'cep' => preg_replace('/\D/', '', $data['cep']),
            'muni_resid' => $data['muniResid'],
            'uf_resid' => $data['ufResid'],
            'logradouro' => $this->formataText($data['logradouro']),
            'numero' => $data['numero'],
            'complemento' => $this->formataText($data['complemento']),
            'bairro' => $this->formataText($data['bairro']),
            'cpf' => preg_replace('/\D/', '', $data['cpf']),
            'pis' => preg_replace('/\D/', '', $data['pis']),
            'rg' => $this->formataText($data['rg'], ''),
            'rg_orgao' => $this->formataText($data['rgOrgao']),
            'rg_orgao_uf' => $data['rgOrgaoUf'],
            'rg_data_emissao' => $data['rgDataEmissao'],
            'titulo_eleitor' => preg_replace('/\D/', '', $data['tituloEleitor']),
            'titulo_zona' => preg_replace('/\D/', '', $data['tituloZona']),
            'titulo_secao' => preg_replace('/\D/', '', $data['tituloSecao']),
            'certificado_reservista' => preg_replace('/\D/', '', $data['certificadoReservista']),
        ]);

        Auth('bolsistas')->attempt([
            'cpf' => $data['cpf'],
            'password' => $data['password'],
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

    public function formataText(string $text, string $separator = ' '): string
    {
        return str::upper(str::slug($text, $separator, 'pt_BR'));
    }
}
