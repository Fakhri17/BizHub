<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_product_id',
        'user_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'umkm_product_id' => 'integer',
        'user_id' => 'integer',
        'rating' => 'integer',
    ];

    public function umkmProduct()
    {
        return $this->belongsTo(UmkmProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
