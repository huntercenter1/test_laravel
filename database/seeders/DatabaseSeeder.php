<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Asegura países sin duplicar
        $this->call(CountrySeeder::class);

        // Usuario por defecto idempotente (no rompe si ya existe)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Si quieres usuarios de prueba adicionales, asegúrate de emails únicos
        // \App\Models\User::factory()->count(5)->create(); // (opcional)
    }
}
