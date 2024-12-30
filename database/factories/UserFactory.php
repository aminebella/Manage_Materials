<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Sector;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Default password
            'sector_id' => Sector::factory(),//Hash::make('password')
            'role' =>'user',//$this->faker->randomElement(['admin', 'user'])
        ];
    }

    
}
