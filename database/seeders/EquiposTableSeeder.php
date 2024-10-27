<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Equipo;

class EquiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Equipo::insert([
            [
                'nombre' => "EF CAN BOADA 'A'",
                'escudo' => 'escudos/canboada.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PENYA BLAUGRANA S.C. "A"',
                'escudo' => 'escudos/penya_blaugrana_sc_a.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CFCS JUAN XXIII _ PREBENJAMIN C',
                'escudo' => 'escudos/cfcs_juan_xxiii_prebenjamin_c.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CE ÀGORA "A" (2017)',
                'escudo' => 'escudos/ce_agora_a.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CP SAN CRISTOBAL C',
                'escudo' => 'escudos/cp_san_cristobal_c.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CFCS JUAN XXIII _ PREBENJAMIN B',
                'escudo' => 'escudos/cfcs_juan_xxiii.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CE LA FARGA XXI "A" (2017)',
                'escudo' => 'escudos/ce_la_farga_xxi_a.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CE LA FARGA XXI "B" (2017)',
                'escudo' => 'escudos/ce_la_farga_xxi_a.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


