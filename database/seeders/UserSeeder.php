<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'firstname' => 'no user,not affected yet',
            'lastname' => 'no user,not affected yet',
            'email' => 'no user,not affected yet@gmail.com',
            'password' => 'no user,not affected yet',
            'sector_id' => 1,//Sector::factory()
            'role' => 'user',
        ]);

        User::create([
            'firstname' => 'Mustapha',
            'lastname' => 'Bella',
            'email' => 'MustaphaAdmin@example.com',
            'password' => Hash::make('password'),
            'sector_id' => 1,//Sector::factory()
            'role' => 'admin',
        ]);

        User::factory(10)->create();
    }
}
