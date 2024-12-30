<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        Material::create(
            [ 
                'type_id' => 1,
                'brand_id' => 1,
                'name' => 'no material ,not affected yet',
                'status' => 'libre',
                'user_id' => 1,
            ]
        );

        Material::factory(10)->create(); // Crée 10 matériels
    }
}

