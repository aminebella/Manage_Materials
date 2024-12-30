<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintenance;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        Maintenance::create([
            'user_id' => 1,
            'material_id' => 1,
            'status' => 'en cours', //'en attente'
            // 'date_maintenance' => now(),
        ]);

        Maintenance::factory(5)->create(); // Crée 5 maintenances
    }
}

