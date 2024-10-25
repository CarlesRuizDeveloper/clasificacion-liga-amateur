<?php

namespace App\Annotations\OpenApi\Controllers;

/**
 * @OA\PathItem(path="/equipos")
 */
class EquipoAnnotation
{
    /**
     * @OA\Get(
     *     path="/equipos",
     *     operationId="listarEquipos",
     *     tags={"Equipos"},
     *     summary="Listar todos los equipos",
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Equipo")
     *             )
     *         )
     *     )
     * )
     */
    public function index() {}

    /**
     * @OA\Post(
     *     path="/equipos",
     *     operationId="crearEquipo",
     *     tags={"Equipos"},
     *     summary="Crear un nuevo equipo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string", example="CE ÀGORA 'A'"),
     *             @OA\Property(property="escudo", type="string", example="url_del_escudo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Equipo creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Equipo")
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
     *     path="/equipos/{id}",
     *     operationId="obtenerEquipo",
     *     tags={"Equipos"},
     *     summary="Obtener un equipo específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del equipo",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/Equipo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     )
     * )
     */
    public function show($id) {}

    /**
     * @OA\Put(
     *     path="/equipos/{id}",
     *     operationId="actualizarEquipo",
     *     tags={"Equipos"},
     *     summary="Actualizar un equipo existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del equipo",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nombre", type="string", example="CE ÀGORA 'A'"),
     *             @OA\Property(property="escudo", type="string", example="url_del_escudo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Equipo actualizado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/Equipo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     )
     * )
     */
    public function update($id) {}

    /**
     * @OA\Delete(
     *     path="/equipos/{id}",
     *     operationId="eliminarEquipo",
     *     tags={"Equipos"},
     *     summary="Eliminar un equipo existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del equipo",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Equipo eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Equipo no encontrado"
     *     )
     * )
     */
    public function destroy($id) {}
}
