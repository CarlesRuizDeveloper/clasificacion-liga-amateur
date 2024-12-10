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
            ->where ('jornada', $jornada)
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
        $partido->update($request->only([
            'equipo_local_id',
            'equipo_visitante_id',
            'fecha',
            'hora',
            'goles_local',
            'goles_visitante',
            'pts_fed_local',  
            'pts_fed_visitante'
        ]));
    
        $partido->pts_fed_local = $request->input('pts_fed_local');
        $partido->pts_fed_visitante = $request->input('pts_fed_visitante');
    
        $partido->pts_local = $this->calcularPuntosNormales($partido->goles_local, $partido->goles_visitante);
        $partido->pts_visitante = $this->calcularPuntosNormales($partido->goles_visitante, $partido->goles_local);
    
        $partido->save();
    
        return $partido->load(['equipoLocal', 'equipoVisitante']);
    }
    
    private function calcularPuntosNormales($golesPropios, $golesOponentes)
    {
        if ($golesPropios > $golesOponentes) {
            return 3;
        } elseif ($golesPropios < $golesOponentes) {
            return 1;
        } else {
            return 2;
        }
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
                'pts' => 0,
                'pts_fed' => 0  
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
    
        $local['gf'] += $partido->goles_local ?? 0;
        $local['gc'] += $partido->goles_visitante ?? 0;
        $visitante['gf'] += $partido->goles_visitante ?? 0;
        $visitante['gc'] += $partido->goles_local ?? 0;
    
        $local['pts'] += $this->calcularPuntosNormales($partido->pts_fed_local, $partido->pts_fed_visitante);
        $visitante['pts'] += $this->calcularPuntosNormales($partido->pts_fed_visitante, $partido->pts_fed_local);
    
        if ($partido->pts_fed_local > $partido->pts_fed_visitante) {
            $local['pg']++; 
            $visitante['pp']++; 
        } elseif ($partido->pts_fed_local < $partido->pts_fed_visitante) {
            $local['pp']++;
            $visitante['pg']++; 
        } else {
            $local['pe']++; 
            $visitante['pe']++;
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
                if ($a['pts_fed'] === $b['pts_fed']) {
                    return $b['dg'] - $a['dg'];
                }
                return $b['pts_fed'] - $a['pts_fed'];
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

    public function obtenerUltimaJornadaConResultados()
    {
        $ultimaJornada = Partido::whereNotNull('goles_local')
            ->whereNotNull('goles_visitante')
            ->max('jornada');

        return $ultimaJornada ?? 1;
    }
}
