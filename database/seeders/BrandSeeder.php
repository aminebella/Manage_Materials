<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::create(
            [
                'brand_name' => 'no brand ,not affected yet',
            ]
        );

        Brand::factory(5)->create(); // Crée 5 marques
    }
}


