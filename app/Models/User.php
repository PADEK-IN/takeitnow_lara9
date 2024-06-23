<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getHashidAttribute()
    {
        return Hashids::encode($this->id);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
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
        'email_verified_at' => 'datetime',
    ];

    public function userTransaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'id_user');
    }

    public function userReview(): HasMany
    {
        return $this->hasMany(Review::class, 'id_user');
    }
}
