<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => env('ADMIN_EMAIL', 'juan@juan.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'Aa123456789')),
        ]);
    }
}
