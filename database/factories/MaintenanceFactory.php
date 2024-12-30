<?php

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\User;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    protected $model = Maintenance::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'material_id' => Material::factory(),
            'status' => $this->faker->randomElement(['en cours', 'terminé']),
            // 'date_maintenance' => $this->faker->dateTimeThisYear(),
        ];
    }
}

