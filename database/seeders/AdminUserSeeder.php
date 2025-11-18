<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $u = User::firstOrCreate(
            ['email'=>'admin@koperasi.test'],
            ['name'=>'Admin Koperasi','password'=>bcrypt('password')]
        );
        $u->assignRole('admin');
    }
}
