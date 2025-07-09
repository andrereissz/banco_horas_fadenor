<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bolsista extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'email',
        'status_solicitacao'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
