<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        BlogCategory::truncate();
        Schema::enableForeignKeyConstraints();

        // with produk or marketing theme
        $blogCategoryList = [
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Produk',
                'slug' => 'produk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($blogCategoryList as $blogCategory) {
            BlogCategory::create($blogCategory);
        }
    }
}
