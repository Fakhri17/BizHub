<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
       
        $superAdmin = User::create([
            'username' => 'superadmin',
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567890',
            'password' => Hash::make('admin123'),
            'address' => 'Jl. Raya No. 1',
            'role_id' => '1'
        ]);

        $superAdmin->assignRole('Super Admin');

        $umkmOwner = User::create([
            'username' => 'umkmowner',
            'name' => 'UMKM Owner',
            'email' => 'umkmowner@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567891',
            'password' => Hash::make('umkm123'),
            'address' => 'Jl. Raya No. 2',
            'role_id' => '2'
        ]);
        
        $umkmOwner->assignRole('UMKM Owner');

        $umkmOwner2 = User::create([
            'username' => 'umkmowner2',
            'name' => 'UMKM Owner 2',
            'email' => 'umkmowner2@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567891',
            'password' => Hash::make('umkm123'),
            'address' => 'Jl. Raya No. 2',
            'role_id' => '2'
        ]);

        $umkmOwner2->assignRole('UMKM Owner');

        $customer = User::create([
            'username' => 'customer',
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'avatar_path' => '', // Add this line
            'phone_number' => '081234567892',
            'password' => Hash::make('customer123'),
            'address' => 'Jl. Raya No. 3',
            'role_id' => '3'
        ]);

        $customer->assignRole('Customer');

        // User::insert($users);
    }
}
