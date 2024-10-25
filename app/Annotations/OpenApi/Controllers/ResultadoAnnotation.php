<?php

namespace App\Annotations\OpenApi\Controllers;

/**
 * @OA\PathItem(path="/resultados")
 */
class ResultadoAnnotation
{
    /**
     * @OA\Get(
     *     path="/resultados",
     *     operationId="listarResultados",
     *     tags={"Resultados"},
     *     summary="Listar todos los resultados",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Resultado")
     *             )
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/resultados",
     *     operationId="crearResultado",
     *     tags={"Resultados"},
     *     summary="Crear un nuevo resultado",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="equipo_local_id", type="integer", example=1),
     *             @OA\Property(property="equipo_visitante_id", type="integer", example=2),
     *             @OA\Property(property="goles_local", type="integer", example=3),
     *             @OA\Property(property="goles_visitante", type="integer", example=1),
     *             @OA\Property(property="fecha", type="string", format="date", example="2024-10-30"),
     *             @OA\Property(property="hora", type="string", format="time", example="15:30")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resultado creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Resultado")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store() {}

    /**
     * @OA\Get(
     *     path="/resultados/{id}",
     *     operationId="obtenerResultado",
     *     tags={"Resultados"},
     *     summary="Obtener un resultado específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del resultado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/Resultado")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resultado no encontrado"
     *     )
     * )
     */
    public function show($id) {}

    /**
     * @OA\Put(
     *     path="/resultados/{id}",
     *     operationId="actualizarResultado",
     *     tags={"Resultados"},
     *     summary="Actualizar un resultado existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del resultado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="equipo_local_id", type="integer", example=1),
     *             @OA\Property(property="equipo_visitante_id", type="integer", example=2),
     *             @OA\Property(property="goles_local", type="integer", example=3),
     *             @OA\Property(property="goles_visitante", type="integer", example=1),
     *             @OA\Property(property="fecha", type="string", format="date", example="2024-10-30"),
     *             @OA\Property(property="hora", type="string", format="time", example="15:30")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resultado actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Resultado")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resultado no encontrado"
     *     )
     * )
     */
    public function update($id) {}

    /**
     * @OA\Delete(
     *     path="/resultados/{id}",
     *     operationId="eliminarResultado",
     *     tags={"Resultados"},
     *     summary="Eliminar un resultado existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del resultado",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Resultado eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resultado no encontrado"
     *     )
     * )
     */
    public function destroy($id) {}
}
