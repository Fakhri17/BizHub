<?php

namespace Database\Seeders;

use App\Models\UmkmOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UmkmOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        UmkmOwner::truncate();
        Schema::enableForeignKeyConstraints();

        $umkmOwner = UmkmOwner::create([
            'user_id' => 2,
            'npwp' => '12.312.312.3-213.123'
        ]);

        $umkmOwner->user->assignRole('UMKM Owner');

        $umkmOwner2 = UmkmOwner::create([
            'user_id' => 3,
            'npwp' => '12.312.312.3-213.125'
        ]);

        $umkmOwner2->user->assignRole('UMKM Owner');
    }
}
