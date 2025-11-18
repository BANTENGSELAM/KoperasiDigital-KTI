<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name'=>'admin']);
        Role::firstOrCreate(['name'=>'petugas']);
        Role::firstOrCreate(['name'=>'restoran_umkm']);
        Role::firstOrCreate(['name'=>'edukator']);
    }
}
