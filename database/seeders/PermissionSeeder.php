<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
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
            // blog model
            'create blog',
            'read blog',
            'update blog',
            'delete blog',
            // blog category blog model
            'create blog category',
            'read blog category',
            'update blog category',
            'delete blog category',
            // umkm product model
            'create umkm product',
            'read umkm product',
            'update umkm product',
            'delete umkm product',
            // Product category model
            'create product category',
            'read product category',
            'update product category',
            'delete product category',
            
            

   
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
