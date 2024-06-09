<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'umkm_product_id',
        'parent_id',
        'comment_text',
        'likes_count',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'umkm_product_id' => 'integer',
        'parent_id' => 'integer',
        'likes_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function umkmProduct()
    {
        return $this->belongsTo(UmkmProduct::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }


}
