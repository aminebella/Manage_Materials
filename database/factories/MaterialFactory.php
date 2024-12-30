<?php

namespace Database\Factories;

use App\Models\Material;
use App\Models\Type;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    protected $model = Material::class;

    public function definition()
    {
        return [
            'type_id' => Type::factory(),
            'brand_id' => Brand::factory(),
            'name' => $this->faker->word,
            'status' => $this->faker->randomElement(['libre', 'occupé', 'en maintenance', 'réparé']),
            'user_id' => User::factory(),
        ];
    }
}

