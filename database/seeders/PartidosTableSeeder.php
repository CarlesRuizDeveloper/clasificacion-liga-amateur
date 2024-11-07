<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartidosTableSeeder extends Seeder
{
    public function run()
    {
        $partidosPorJornada = [
            [
                'jornada' => 1,
                'partidos' => [
                    ['equipo_local_id' => 1, 'equipo_visitante_id' => 2, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 19, 10, 30)],
                    ['equipo_local_id' => 3, 'equipo_visitante_id' => 4, 'goles_local' => 4, 'goles_visitante' => 12, 'fecha' => Carbon::create(2024, 10, 19, 10, 15)],
                    ['equipo_local_id' => 5, 'equipo_visitante_id' => 6, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 19, 10, 15)],
                    ['equipo_local_id' => 7, 'equipo_visitante_id' => 8, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 19, 9, 0)],
                ],
            ],
            [
                'jornada' => 2,
                'partidos' => [
                    ['equipo_local_id' => 5, 'equipo_visitante_id' => 7, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 26, 11, 45)],
                    ['equipo_local_id' => 4, 'equipo_visitante_id' => 1, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 26, 10, 15)],
                    ['equipo_local_id' => 6, 'equipo_visitante_id' => 3, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 26, 12, 0)],
                    ['equipo_local_id' => 8, 'equipo_visitante_id' => 5, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 10, 25, 19, 0)],
                ],
            ],
            [
                'jornada' => 3,
                'partidos' => [
                    ['equipo_local_id' => 5, 'equipo_visitante_id' => 4, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 9, 9, 45)],
                    ['equipo_local_id' => 2, 'equipo_visitante_id' => 6, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 9, 11, 30)],
                    ['equipo_local_id' => 3, 'equipo_visitante_id' => 1, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 9, 10, 15)],
                    ['equipo_local_id' => 8, 'equipo_visitante_id' => 7, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 9, 12, 45)],
                ],
            ],
            [
                'jornada' => 4,
                'partidos' => [
                    ['equipo_local_id' => 4, 'equipo_visitante_id' => 7, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 23, 10, 15)],
                    ['equipo_local_id' => 6, 'equipo_visitante_id' => 5, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 23, 12, 30)],
                    ['equipo_local_id' => 2, 'equipo_visitante_id' => 1, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 23, 10, 15)],
                    ['equipo_local_id' => 3, 'equipo_visitante_id' => 8, 'goles_local' => null, 'goles_visitante' => null, 'fecha' => Carbon::create(2024, 11, 23, 10, 15)],
                ],
            ],

        ];

        foreach ($partidosPorJornada as $jornadaData) {
            foreach ($jornadaData['partidos'] as $partido) {
                DB::table('partidos')->insert([
                    'jornada' => $jornadaData['jornada'],
                    'equipo_local_id' => $partido['equipo_local_id'],
                    'equipo_visitante_id' => $partido['equipo_visitante_id'],
                    'goles_local' => $partido['goles_local'],
                    'goles_visitante' => $partido['goles_visitante'],
                    'fecha' => $partido['fecha'],
                ]);
            }
        }
    }
}
