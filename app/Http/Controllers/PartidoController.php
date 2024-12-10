<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Services\PartidoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartidoController extends Controller
{
    protected $partidoService;

    public function __construct(PartidoService $partidoService)
    {
        $this->partidoService = $partidoService;
    }

    public function index(Request $request)
    {
        try {
            $jornada = $request->query('jornada');
            if ($jornada) {
                $partidos = $this->partidoService->listarPartidosPorJornada($jornada);
            } else {
                $partidos = $this->partidoService->listarPartidos();
            }

            return response()->json($partidos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hubo un error al obtener los partidos: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $partido = $this->partidoService->crearPartido($request);
        return response()->json($partido, 201);
    }

    public function show(Partido $partido)
    {
        $partidoDetallado = $this->partidoService->verPartido($partido);
        return response()->json($partidoDetallado);
    }

    public function update(Request $request, Partido $partido)
    {
        Log::info('Request received', $request->all());

        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'fecha' => 'nullable|date',
            'hora' => 'nullable|date_format:H:i',
            'goles_local' => 'nullable|integer',
            'goles_visitante' => 'nullable|integer',
            'pts_fed_local' => 'nullable|integer',
            'pts_fed_visitante'  => 'nullable|integer'
        ]);

        Log::info('Validation passed');

        try {
            $partidoActualizado = $this->partidoService->actualizarPartido($request, $partido);
            Log::info('Partido updated', ['partido' => $partidoActualizado]);
            return response()->json($partidoActualizado);
        } catch (\Exception $e) {
            Log::error('Error updating partido', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error updating partido: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Partido $partido)
    {
        $this->partidoService->eliminarPartido($partido);
        return response()->json(null, 204);
    }

    public function clasificacionPorJornada($jornada)
    {
        try {
            $clasificacion = $this->partidoService->obtenerClasificacionPorJornada($jornada);
            return response()->json($clasificacion, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la clasificación: ' . $e->getMessage()], 500);
        }
    }
    

    public function clasificacionUltimaJornada()
    {
        try {
            $clasificacion = $this->partidoService->obtenerClasificacionUltimaJornada();
            return response()->json($clasificacion, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la clasificación: ' . $e->getMessage()], 500);
        }
    }
    

    public function obtenerUltimaJornada()
    {
        try {
            $ultimaJornada = $this->partidoService->obtenerUltimaJornadaConResultados();
            return response()->json(['ultima_jornada' => $ultimaJornada], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la última jornada: ' . $e->getMessage()], 500);
        }
    }
}
