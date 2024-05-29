<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavoriteProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'umkm_product_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'umkm_product_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function umkmProduct()
    {
        return $this->belongsTo(UmkmProduct::class);
    }
}
