<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role',
        'is_email_verified',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function device()
    {
       return $this->hasMany(UserDevice::class, "user_id");
    }


    public function scopeFilter($query, array $fillters) {
        $query->when($fillters['role'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('role', $search);
            });
        });

        $query->when($fillters['verified'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('is_email_verified', $search);
            });
        });

        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%'. $search. '%')
                ->orWhere('name', 'like', '%'. $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%');
            });
        });
    }
}
