<?php

namespace App\Http\Controllers;

use App\Models\Partido;
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
        $resultados = Partido::with(['equipoLocal', 'equipoVisitante', 'resultado'])->get();
        return response()->json($resultados);
    }

    public function store(Request $request)
    {
        $request->validate([
            'partido_id' => 'required|exists:partidos,id',
            'goles_local' => 'nullable|integer|min:0',
            'goles_visitante' => 'nullable|integer|min:0'
        ]);

        $resultado = $this->resultadoService->crearResultado($request);
        return response()->json($resultado, 201);
    }

    public function show($jornada)
    {
        $partidos = Partido::where('jornada', $jornada)->with(['equipoLocal', 'equipoVisitante', 'resultado'])->get();
        return response()->json($partidos);
    }
}
