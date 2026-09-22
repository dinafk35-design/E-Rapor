<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@erapor.test',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'guru'],
            [
                'name' => 'Guru E-Rapor',
                'email' => 'guru@erapor.test',
                'password' => Hash::make('guru123'),
                'role' => 'guru',
            ]
        );

        User::updateOrCreate(
            ['username' => 'siswa'],
            [
                'name' => 'Siswa E-Rapor',
                'email' => 'siswa@erapor.test',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        );
    }
}