<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $Operator = Role::create(['name' => 'Operator']);
        $admin->givePermissionTo([
            'create-mahasiswa',
            'edit-mahasiswa',
            'delete-mahasiswa',
            'create-matakuliah',
            'edit-matakuliah',
            'delete-matakuliah'
        ]);
        $Operator->givePermissionTo([
            'create-matakuliah',
            'edit-matakuliah',
            'delete-matakuliah'
        ]);
    }
}
