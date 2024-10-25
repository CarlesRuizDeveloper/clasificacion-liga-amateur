<?php

namespace App\Annotations\OpenApi;

/**
 * @OA\Info(
 *     title="Clasificación Liga Amateur API",
 *     version="1.0.0",
 *     description="Documentación de la API para la clasificación de una liga de fútbol amateur",
 *     @OA\Contact(
 *         email="soporte@tudominio.com"
 *     )
 * )
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Introduce el token de autenticación en el formato 'Bearer {token}'",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="sanctum"
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor principal"
 * )
 * @OA\Schema(
 *     schema="Equipo",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nombre", type="string", example="CE ÀGORA 'A'"),
 *     @OA\Property(property="escudo", type="string", example="url_del_escudo")
 * )
 * @OA\Schema(
 *     schema="Resultado",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="equipo_local_id", type="integer", example=1),
 *     @OA\Property(property="equipo_visitante_id", type="integer", example=2),
 *     @OA\Property(property="goles_local", type="integer", example=3),
 *     @OA\Property(property="goles_visitante", type="integer", example=4),
 *     @OA\Property(property="fecha", type="string", format="date", example="2024-10-19"),
 *     @OA\Property(property="hora", type="string", format="time", example="10:30")
 * )
 */
class OpenApi
{ }
