<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'operator',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}