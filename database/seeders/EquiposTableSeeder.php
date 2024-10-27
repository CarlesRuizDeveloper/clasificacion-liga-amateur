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
                'nombre' => 'CE ÀGORA "A"',
                'escudo' => 'escudos/equipo_1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'EF CAN BOADA "A"',
                'escudo' => 'escudos/equipo_1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CFCS JUAN XXIII _ PREBENJAMIN B',
                'escudo' => 'escudos/equipo_1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'CP SAN CRISTOBAL C',
                'escudo' => 'escudos/equipo_1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

