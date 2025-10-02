<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('countries')->insert([
            ['name' => 'Colombia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Argentina', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'México', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Perú', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chile', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
