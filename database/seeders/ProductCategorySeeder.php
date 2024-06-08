<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        ProductCategory::truncate();
        Schema::enableForeignKeyConstraints();

        $productCategories = [
            [
                'category_name' => 'Fashion',
                'slug' => 'fashion',
                'category_image' => '',
                'category_description' => 'Fashion products',
            ],
            [
                'category_name' => 'Food & Beverage',
                'slug' => 'food-beverage',
                'category_image' => '',
                'category_description' => 'Food & Beverage products',
            ],
            [
                'category_name' => 'Health & Beauty',
                'slug' => 'health-beauty',
                'category_image' => '',
                'category_description' => 'Health & Beauty products',
            ],
            [
                'category_name' => 'Home & Living',
                'slug' => 'home-living',
                'category_image' => '',
                'category_description' => 'Home & Living products',
            ],
            [
                'category_name' => 'Hobby & Toys',
                'slug' => 'hobby-toys',
                'category_image' => '',
                'category_description' => 'Hobby & Toys products',
            ],
            [
                'category_name' => 'Electronics',
                'slug' => 'electronics',
                'category_image' => '',
                'category_description' => 'Electronics products',
            ],
            [
                'category_name' => 'Automotive',
                'slug' => 'automotive',
                'category_image' => '',
                'category_description' => 'Automotive products',
            ],
            [
                'category_name' => 'Books & Stationery',
                'slug' => 'books-stationery',
                'category_image' => '',
                'category_description' => 'Books & Stationery products',
            ],
            [
                'category_name' => 'Sports & Outdoor',
                'slug' => 'sports-outdoor',
                'category_image' => '',
                'category_description' => 'Sports & Outdoor products',
            ],
            [
                'category_name' => 'Others',
                'slug' => 'others',
                'category_image' => '',
                'category_description' => 'Other products',
            ],

        ];

        foreach ($productCategories as $productCategory) {
            ProductCategory::create($productCategory);
        }
    }
}
