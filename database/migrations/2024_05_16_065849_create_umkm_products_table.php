<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkm_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_owner_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->string('product_image')->nullable();
            $table->string('product_description')->nullable();
            $table->decimal('product_price', 10, 2);
            $table->foreignId('product_category_id')->constrained()->cascadeOnDelete();
            $table->string('product_location');
            $table->boolean('is_published')->default(false);
            $table->json('tags')->nullable();
            $table->json('product_social_media')->nullable();
            $table->json('product_gallery')->nullable();
            // rating count
            $table->integer('rating_count')->default(0);
            // rating sum
            $table->integer('rating_sum')->default(0);
            // rating average
            $table->decimal('rating_average', 2, 1)->default(0);
            // comment
            $table->integer('comment_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_products');
    }
};
