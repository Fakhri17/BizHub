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
        //
        $roles = [
            'Super Admin',
            'UMKM Owner',
            'Customer',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        $superAdmin = Role::findByName('Super Admin');

        $superAdmin->givePermissionTo([
            'create users',
            'read user',
            'update user',
            'delete user',
            'create role',
            'read role',
            'update role',
            'delete role',
            'create permission',
            'read permission',
            'update permission',
            'delete permission',
        ]);
    }
}
