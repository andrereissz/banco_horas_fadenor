<?php

namespace App\Models;

use App\Enums\BolsaStatus;
use App\Enums\BolsaTipo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bolsa extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'status' => BolsaStatus::class,
        'tipo' => BolsaTipo::class
    ];

    protected $fillable = [
        // Vínculo
        'user_id',

        // Dados Básicos
        'nome',

        // Dados da Bolsa
        'token',
        'status',
        'projeto_cod',
        'projeto_nome',
        'projeto_num',
        'tipo',
        'data_inicio',
        'data_fim',
        'valor',


        // Banco
        'banco_nome',
        'banco_cod',
        'agencia',
        'agencia_digito',
        'conta',
        'conta_digito'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(Documento::class);
    }

    public function bolsista(): BelongsTo
    {
        return $this->belongsTo(Bolsista::class);
    }

    public function scopeSearch($query, string $search)
    {
        return $query->where('nome', 'like', "%{$search}%")
            ->orWhere('projeto_cod', 'like', "%{$search}%")
            ->orWhere('projeto_nome', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('cpf', 'like', "%{$search}%");
    }
}
