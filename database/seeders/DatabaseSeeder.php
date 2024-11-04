<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Registrar el seeder para los equipos
        $this->call(EquiposTableSeeder::class);
        $this->call(PartidosTableSeeder::class);
    }
}
