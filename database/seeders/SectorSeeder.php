<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    public function run()
    {
        Sector::create([
            'sector_name' => 'no sector,not affected yet',
        ]);

        Sector::factory(5)->create(); // Crée 5 secteurs
    }
}
