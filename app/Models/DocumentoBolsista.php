<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DocumentoBolsista extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'bolsista_id',
        'tipo',
        'nome',
        'caminho',
    ];

    public function bolsista()
    {
        return $this->belongsTo(Bolsista::class);
    }
}
