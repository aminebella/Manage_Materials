<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\User;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    protected $model = Request::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'material_id' => Material::factory(),
            'status' => $this->faker->randomElement(['en attente', 'accepté', 'refusé'])
        ];
    }
}

