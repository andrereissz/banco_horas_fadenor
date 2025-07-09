<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoBolsista extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'bolsista_id',
        'caminho',
        'documento'
    ];

    public function bolsista()
    {
        return $this->belongsTo(Bolsista::class);
    }
}
