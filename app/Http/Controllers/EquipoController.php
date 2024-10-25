<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Services\EquipoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EquipoController extends Controller
{
    protected $equipoService;

    public function __construct(EquipoService $equipoService)
    {
        $this->equipoService = $equipoService;
    }

    public function index()
    {
        $equipos = $this->equipoService->listarEquipos();
        return response()->json($equipos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:equipos',
            'escudo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $equipo = $this->equipoService->crearEquipo($request);
        return response()->json($equipo, 201);
    }

    public function show(Equipo $equipo)
    {
        return response()->json($this->equipoService->verEquipo($equipo));
    }
    

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre' => 'required|string|unique:equipos,nombre,' . $equipo->id,
            'escudo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $equipo = $this->equipoService->actualizarEquipo($request, $equipo);
        return response()->json($equipo);
    }

    public function destroy(Equipo $equipo)
    {
        try {
            $this->equipoService->eliminarEquipo($equipo);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'No se pudo eliminar el equipo: ' . $e->getMessage()], 500);
        }
    }
    
    
}
