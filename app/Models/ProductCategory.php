<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'category_image',
        'category_description',
    ];

    public function products()
    {
        return $this->hasMany(UmkmProduct::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
