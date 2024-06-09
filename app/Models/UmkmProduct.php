<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_owner_id',
        'product_name',
        'slug',
        'product_description',
        'product_image',
        'product_price',
        'product_category_id',
        'product_location',
        'product_social_media',
        'product_gallery',
        'tags',
        'is_published',
    ];

    protected $casts = [
        'umkm_owner_id' => 'integer',
        'product_category_id' => 'integer',
        'is_published' => 'boolean',
        'tags' => 'array',
        'product_social_media' => 'array',
        'product_gallery' => 'array',
    ];

    public function umkmOwner()
    {
        return $this->belongsTo(UmkmOwner::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSocialMediaAttribute()
    {
        return collect($this->product_social_media)->map(function ($socialMedia) {
            return [
                'icon' => $socialMedia['icon'], // 'fab fa-instagram
                'username' => $socialMedia['username'],
                'url' => $socialMedia['url'],
            ];
        });
    }

    public function setProductSocialMediaAttribute($value)
    {
        $this->attributes['product_social_media'] = json_encode($value);
    }

    public function getGalleryAttribute()
    {
        return collect($this->product_gallery)->map(function ($gallery) {
            return $gallery['url'];
        });
    }

    public function setProductGalleryAttribute($value)
    {
        $this->attributes['product_gallery'] = json_encode($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
