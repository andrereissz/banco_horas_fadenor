<?php

namespace App\Models;

use App\Enums\DocumentoTipo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $casts = [
        'tipo' => DocumentoTipo::class,
    ];

    protected $keyType = 'string';

    protected $fillable = [
        'bolsa_id',
        'tipo',
        'nome',
        'caminho',
    ];

    public function bolsas()
    {
        return $this->belongsTo(Bolsa::class);
    }
}
