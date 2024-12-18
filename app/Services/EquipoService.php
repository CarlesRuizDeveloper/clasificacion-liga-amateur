<?php

namespace App\Services;

use App\Models\Equipo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class EquipoService
{
    public function listarEquipos()
    {
        return Equipo::all();
    }

    public function crearEquipo(Request $request)
    {
        $escudoPath = $request->file('escudo') ? $request->file('escudo')->store('escudos', 'public') : null;
    
        return Equipo::create([
            'nombre' => $request->nombre,
            'escudo' => $escudoPath
        ]);
    }

    public function verEquipo(Equipo $equipo)
    {
        $equipo->escudo_url = $equipo->escudo_url;
        return $equipo;
    }
    
    public function actualizarEquipo(Request $request, Equipo $equipo)
    {
        if ($request->hasFile('escudo')) {            
            if ($equipo->escudo) {
                Storage::disk('public')->delete($equipo->escudo);
            }
            $equipo->escudo = $request->file('escudo')->store('escudos', 'public');
        }
    
        $equipo->nombre = $request->nombre;
        $equipo->save();
    
        return $equipo;
    }

    public function eliminarEquipo(Equipo $equipo)
    {  
        if ($equipo->escudo) {
            Storage::disk('public')->delete($equipo->escudo);
        }
        $equipo->delete();
        return true;
    }
    
    
}
