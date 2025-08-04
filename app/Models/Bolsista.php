<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bolsista extends Model
{
    protected $fillable = [
        // Dados pessoais
        'nome',
        'data_nasc',
        'nome_mae',
        'nome_pai',
        'estado_civil',
        'raca_cor',
        'telefone',
        'email',
        'escolaridade',

        // Naturalidade
        'muni_nasc',
        'uf_nasc',

        // Endereço
        'cep',
        'muni_resid',
        'uf_resid',
        'logradouro',
        'numero',
        'complemento',
        'bairro',

        // Documentos
        'cpf',
        'pis',
        'rg',
        'rg_orgao',
        'rg_orgao_uf',
        'rg_data_emissao',
        'titulo_eleitor',
        'titulo_zona',
        'titulo_secao',
        'certificado_reservista'
    ];
    public function bolsas(): HasMany
    {
        return $this->hasMany(Bolsa::class);
    }
}
