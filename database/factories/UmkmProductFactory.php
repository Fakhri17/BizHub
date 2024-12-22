<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\UmkmOwner;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UmkmProduct;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UmkmProduct>
 */
class UmkmProductFactory extends Factory
{
    protected $model = UmkmProduct::class;
    public function definition(): array
    {
        return [
            'umkm_owner_id' => UmkmOwner::factory(),
            'product_name' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'product_image' => $this->faker->imageUrl(640, 480, 'umkm_products', true),
            'product_description' => $this->faker->paragraphs(3, true),
            'product_price' => $this->faker->randomFloat(2, 1000, 1000000),
            'product_category_id' => ProductCategory::factory(),
            'product_location' => $this->faker->address,
            'is_published' => $this->faker->boolean,
            
        ];
    }
}
