<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\UmkmProduct;

class UmkmProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        UmkmProduct::truncate();
        Schema::enableForeignKeyConstraints();

        // UmkmProduct::factory()
        //     ->count(10)
        //     ->create();
    }
}
