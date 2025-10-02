<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Colombia','Argentina','México','Perú','Chile'] as $n) {
            Country::firstOrCreate(['name' => $n]);
        }
    }
}
