<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomLupaPassword;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements HasAvatar
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'avatar_path',
        'phone_number',
        'password',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role_id' => 'integer', // Add this line
        'email_verified_at' => 'datetime',
    ];

    public function umkmOwner()
    {
        return $this->hasOne(UmkmOwner::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_path ? asset('storage/'.$this->avatar_path) : "https://ui-avatars.com/api/?name=$this->name&color=6ABF6A&background=213764";
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomLupaPassword($token));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
