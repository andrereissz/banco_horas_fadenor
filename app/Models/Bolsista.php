<?php

namespace App\Models;

use App\Notifications\ResetPasswordBolsistaNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class Bolsista extends User
{
    use HasFactory, HasUuids;

    protected $fillable = [
        // Dados pessoais
        'nome',
        'data_nasc',
        'nome_mae',
        'nome_pai',
        'estado_civil',
        'sexo',
        'raca_cor',
        'telefone',
        'email',
        'escolaridade',

        // Naturalidade
        'est_pais',
        'est_muni',
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
        'certificado_reservista',

        // Senha
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bolsas(): HasMany
    {
        return $this->hasMany(Bolsa::class);
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordBolsistaNotification($token));
    }
}
