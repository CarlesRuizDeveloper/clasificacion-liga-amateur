<?php

namespace App\Annotations\OpenApi\Controllers;

/**
 * @OA\PathItem(path="/api/resultados")
 */
class ResultadoAnnotation
{
    /**
     * @OA\Get(
     *     path="/api/resultados",
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

   
}
