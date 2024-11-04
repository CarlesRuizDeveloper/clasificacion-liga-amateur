<?php

namespace App\Services;

use App\Models\Partido;
use Illuminate\Http\Request;

class PartidoService
{
    public function listarPartidos()
    {
        // Obtener los partidos con los equipos relacionados
        return Partido::with(['equipoLocal', 'equipoVisitante'])->get();
    }

    public function listarPartidosPorJornada($jornada)
    {
        // Obtener los partidos de la jornada especificada con los equipos relacionados
        return Partido::with(['equipoLocal', 'equipoVisitante'])
            ->where('jornada', $jornada)
            ->get();
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
        return $partido->load(['equipoLocal', 'equipoVisitante']);
    }

    public function actualizarPartido(Request $request, Partido $partido)
    {
        $partido->update([
            'equipo_local_id' => $request->equipo_local_id,
            'equipo_visitante_id' => $request->equipo_visitante_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
        ]);

        return $partido->load(['equipoLocal', 'equipoVisitante']);
    }

    public function eliminarPartido(Partido $partido)
    {
        $partido->delete();
        return true;
    }
}
