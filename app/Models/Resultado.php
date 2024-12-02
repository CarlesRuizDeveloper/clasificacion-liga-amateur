<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $fillable = [
        'partido_id',
        'goles_local',
        'goles_visitante',
        'pts_fed_local',
        'pts_fed_visitante'
    ];

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }
}
