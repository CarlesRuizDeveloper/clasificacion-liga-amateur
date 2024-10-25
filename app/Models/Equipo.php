<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'escudo'];

    public function resultadosLocales()
    {
        return $this->hasMany(Resultado::class, 'equipo_local_id');
    }

    public function resultadosVisitantes()
    {
        return $this->hasMany(Resultado::class, 'equipo_visitante_id');
    }
}
