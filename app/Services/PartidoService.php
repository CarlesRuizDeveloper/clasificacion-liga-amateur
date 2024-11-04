<?php

namespace App\Services;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoService
{
    public function listarPartidos()
    {
        return Partido::with(['equipoLocal', 'equipoVisitante', 'resultado'])->get();
    }

    public function crearPartido(Request $request)
    {
        return Partido::create([
            'equipo_local_id' => $request->equipo_local_id,
            'equipo_visitante_id' => $request->equipo_visitante_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);
    }

    public function verPartido(Partido $partido)
    {
        return $partido->load(['equipoLocal', 'equipoVisitante', 'resultado']);
    }

    public function actualizarPartido(Request $request, Partido $partido)
    {
        $partido->update([
            'equipo_local_id' => $request->equipo_local_id,
            'equipo_visitante_id' => $request->equipo_visitante_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return $partido->load(['equipoLocal', 'equipoVisitante', 'resultado']);
    }

    public function eliminarPartido(Partido $partido)
    {
        $partido->delete();
        return true;
    }
}
