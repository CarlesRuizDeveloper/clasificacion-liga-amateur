<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartidoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('equipos', [EquipoController::class, 'index']);
Route::get('equipos/{equipo}', [EquipoController::class, 'show']);
Route::get('partidos', [PartidoController::class, 'index']);
Route::get('partidos/{partido}', [PartidoController::class, 'show']);
Route::get('clasificacion/jornada/{jornada}', [PartidoController::class, 'clasificacionPorJornada']);
Route::get('clasificacion/ultima', [PartidoController::class, 'clasificacionUltimaJornada']);
Route::get('ultima-jornada', [PartidoController::class, 'obtenerUltimaJornada']);

Route::post('login', [AuthController::class, 'login']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('equipos', [EquipoController::class, 'store']);
    Route::put('equipos/{equipo}', [EquipoController::class, 'update']);
    Route::delete('equipos/{equipo}', [EquipoController::class, 'destroy']);
    Route::post('partidos', [PartidoController::class, 'store']);
    Route::put('partidos/{partido}', [PartidoController::class, 'update']);
    Route::delete('partidos/{partido}', [PartidoController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});
