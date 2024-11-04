<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Services\PartidoService;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    protected $partidoService;

    public function __construct(PartidoService $partidoService)
    {
        $this->partidoService = $partidoService;
    }

    public function index()
    {
        $partidos = $this->partidoService->listarPartidos();
        return response()->json($partidos);
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
        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $partidoActualizado = $this->partidoService->actualizarPartido($request, $partido);
        return response()->json($partidoActualizado);
    }

    public function destroy(Partido $partido)
    {
        $this->partidoService->eliminarPartido($partido);
        return response()->json(null, 204);
    }
}
