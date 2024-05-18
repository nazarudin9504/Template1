<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Nazarudin',
            'email' => 'superadmin@roles.id',
            'password' => Hash::make('123456')
        ]);
        $superAdmin->assignRole('Super Admin');
        // Creating Admin User
        $admin = User::create([
            'name' => 'Hanif',
            'email' => 'admin@roles.id',
            'password' => Hash::make('123456')
        ]);
        $admin->assignRole('Admin');
        // Creating Product Manager User
        $operator = User::create([
            'name' => 'Dimas',
            'email' => 'operator@roles.id',
            'password' => Hash::make('123456')
        ]);
        $operator->assignRole('Operator');
    }
}
