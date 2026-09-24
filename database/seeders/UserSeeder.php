<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'operator'],
            [
                'name' => 'Operator E-Rapor',
                'email' => 'operator@erapor.test',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@erapor.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
