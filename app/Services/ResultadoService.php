<?php

namespace App\Services;

use App\Models\Resultado;
use Illuminate\Http\Request;

class ResultadoService
{
    public function listarResultados()
    {
        return Resultado::with(['equipoLocal', 'equipoVisitante'])->get();
    }

    public function crearResultado(Request $request)
    {
        return Resultado::create($request->all());
    }

    public function verResultado(Resultado $resultado)
    {
        return $resultado->load(['equipoLocal', 'equipoVisitante']);
    }

    public function actualizarResultado(Request $request, Resultado $resultado)
    {
        $resultado->update($request->all());
        return $resultado;
    }

    public function eliminarResultado(Resultado $resultado)
    {
        $resultado->delete();
        return true;
    }
}
