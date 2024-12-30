<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Sector;
use App\Models\User;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Material;
use App\Models\Request;
use App\Models\Maintenance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SectorSeeder::class,
            UserSeeder::class,
            TypeSeeder::class,
            BrandSeeder::class,
            MaterialSeeder::class,
            RequestSeeder::class,
            MaintenanceSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
