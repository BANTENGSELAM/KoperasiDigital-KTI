<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Koperasi',
                'password' => Hash::make('password')
            ]
        );
        $admin->assignRole('admin');

        // Petugas
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@example.com'],
            [
                'name' => 'Petugas Koperasi',
                'password' => Hash::make('password')
            ]
        );
        $petugas->assignRole('petugas');

        // Edukator (opsional)
        $edukator = User::firstOrCreate(
            ['email' => 'edukator@example.com'],
            [
                'name' => 'Edukator Koperasi',
                'password' => Hash::make('password')
            ]
        );
        $edukator->assignRole('edukator');
    }
}
