<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,

        ]);
        
        $this->call(DemoDataSeeder::class);

        // Create Admin User
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole('admin');

        // Create Petugas User
        $petugas = \App\Models\User::firstOrCreate(
            ['email' => 'petugas@example.com'],
            ['name' => 'Petugas', 'password' => bcrypt('password')]
        );
        $petugas->assignRole('petugas');

        // Create UMKM/Restoran User
        $umkm = \App\Models\User::firstOrCreate(
            ['email' => 'preksu@gamil.com'],
            ['name' => 'Restoran Preksu', 'password' => bcrypt('password')]
        );
        $umkm->assignRole('restoran_umkm');
    }
}
