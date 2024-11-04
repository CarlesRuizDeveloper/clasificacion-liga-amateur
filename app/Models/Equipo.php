<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'escudo'];

    protected $appends = ['escudo_url'];

    public function resultadosLocales()
    {
        return $this->hasMany(Resultado::class, 'equipo_local_id');
    }

    public function resultadosVisitantes()
    {
        return $this->hasMany(Resultado::class, 'equipo_visitante_id');
    }

    public function getEscudoUrlAttribute()
    {
        return $this->escudo ? url('storage/' . $this->escudo) : null;
    }
}
