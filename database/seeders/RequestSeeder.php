<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;

class RequestSeeder extends Seeder
{
    public function run()
    {
        Request::create(
            [
                'user_id' => 1,
                'material_id' => 1,
                'status' => 'en attente',
            ]
        );

        Request::factory(5)->create(); // Crée 5 demandes
    }
}

