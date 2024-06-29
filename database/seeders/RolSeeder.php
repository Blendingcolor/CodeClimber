<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Role::create(['name'=>'admin']);
        $usuario=Role::create(['name'=>'usuario']);

        Permission::create(['name'=>'permission'])->syncRoles($admin,$usuario);

        #->assignRole($admin)


    }
}
