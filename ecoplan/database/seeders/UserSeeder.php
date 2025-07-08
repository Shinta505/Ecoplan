<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ecoplan.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'points' => 1000
        ]);

        // Create some demo users
        User::factory(5)->create();
    }
}