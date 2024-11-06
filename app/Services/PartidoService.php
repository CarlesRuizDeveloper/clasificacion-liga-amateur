<?php

namespace App\Services;

use App\Models\Partido;
use Illuminate\Http\Request;
use App\Models\Equipo;

class PartidoService
{
    public function listarPartidos()
    {
        return Partido::with(['equipoLocal', 'equipoVisitante'])->get();
    }

    public function listarPartidosPorJornada($jornada)
    {
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

    public function obtenerClasificacionPorJornada($jornada)
    {
        $clasificacion = $this->inicializarClasificacion();
        $partidos = $this->obtenerPartidosHastaJornada($jornada);
        $clasificacion = $this->procesarPartidos($clasificacion, $partidos);
        $clasificacion = $this->ordenarClasificacion($clasificacion);

        return array_values($clasificacion);
    }

    private function inicializarClasificacion()
    {
        $equipos = Equipo::all();
        $clasificacion = [];

        foreach ($equipos as $equipo) {
            $clasificacion[$equipo->id] = [
                'equipo' => $equipo->nombre,
                'escudo_url' => $equipo->escudo_url,
                'pj' => 0,
                'pg' => 0,
                'pe' => 0,
                'pp' => 0,
                'gf' => 0,
                'gc' => 0,
                'dg' => 0,
                'pts' => 0
            ];
        }

        return $clasificacion;
    }

    private function obtenerPartidosHastaJornada($jornada)
    {
        return Partido::where('jornada', '<=', $jornada)
            ->whereNotNull('goles_local')
            ->whereNotNull('goles_visitante')
            ->with(['equipoLocal', 'equipoVisitante'])
            ->get();
    }

    private function procesarPartidos($clasificacion, $partidos)
    {
        foreach ($partidos as $partido) {
            $this->procesarPartido($clasificacion, $partido);
        }
        return $clasificacion;
    }

    private function procesarPartido(&$clasificacion, $partido)
    {
        $local = &$clasificacion[$partido->equipo_local_id];
        $visitante = &$clasificacion[$partido->equipo_visitante_id];

        $this->actualizarEstadisticasPartido($local, $visitante, $partido);
    }


    private function actualizarEstadisticasPartido(&$local, &$visitante, $partido)
    {
        $local['pj']++;
        $visitante['pj']++;
        $local['gf'] += $partido->goles_local;
        $local['gc'] += $partido->goles_visitante;
        $visitante['gf'] += $partido->goles_visitante;
        $visitante['gc'] += $partido->goles_local;

        if ($partido->goles_local > $partido->goles_visitante) {
            $local['pg']++;
            $visitante['pp']++;
            $local['pts'] += 3;
        } elseif ($partido->goles_local < $partido->goles_visitante) {
            $visitante['pg']++;
            $local['pp']++;
            $visitante['pts'] += 3;
        } else {
            $local['pe']++;
            $visitante['pe']++;
            $local['pts'] += 1;
            $visitante['pts'] += 1;
        }

        $this->actualizarDiferenciaGoles($local);
        $this->actualizarDiferenciaGoles($visitante);
    }

    private function actualizarDiferenciaGoles(&$equipo)
    {
        $equipo['dg'] = $equipo['gf'] - $equipo['gc'];
    }

    private function ordenarClasificacion($clasificacion)
    {
        usort($clasificacion, function ($a, $b) {
            if ($a['pts'] === $b['pts']) {
                return $b['dg'] - $a['dg'];
            }
            return $b['pts'] - $a['pts'];
        });

        return $clasificacion;
    }

    public function obtenerClasificacionUltimaJornada()
    {
        $ultimaJornada = Partido::whereNotNull('goles_local')
            ->whereNotNull('goles_visitante')
            ->max('jornada');

        return $this->obtenerClasificacionPorJornada($ultimaJornada);
    }
}
