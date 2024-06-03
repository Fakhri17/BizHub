<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        Blog::truncate();
        Schema::enableForeignKeyConstraints();

        $BlogList = [
            [
                'title' => 'Blog 1',
                'slug' => 'blog-1',
                'content' => 'Content Blog 1',
                'blog_category_id' => 1,
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Blog 2',
                'slug' => 'blog-2',
                'content' => 'Content Blog 2',
                'blog_category_id' => 2,
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($BlogList as $Blog) {
            Blog::create($Blog);
        }
    }
}
