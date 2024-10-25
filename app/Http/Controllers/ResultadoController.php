<?php

namespace App\Http\Controllers;

use App\Models\Resultado;
use App\Services\ResultadoService;
use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    protected $resultadoService;

    public function __construct(ResultadoService $resultadoService)
    {
        $this->resultadoService = $resultadoService;
    }

    public function index()
    {
        $resultados = $this->resultadoService->listarResultados();
        return response()->json($resultados);
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'goles_local' => 'nullable|integer|min:0',
            'goles_visitante' => 'nullable|integer|min:0',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i'
        ]);

        $resultado = $this->resultadoService->crearResultado($request);
        return response()->json($resultado, 201);
    }

    public function show(Resultado $resultado)
    {
        return response()->json($this->resultadoService->verResultado($resultado));
    }

    public function update(Request $request, Resultado $resultado)
    {
        $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'goles_local' => 'nullable|integer|min:0',
            'goles_visitante' => 'nullable|integer|min:0',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i'
        ]);

        $resultado = $this->resultadoService->actualizarResultado($request, $resultado);
        return response()->json($resultado);
    }

    public function destroy(Resultado $resultado)
    {
        $this->resultadoService->eliminarResultado($resultado);
        return response()->json(null, 204);
    }
}
