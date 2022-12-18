<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    protected $table = 'user_devices';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function scopeFilter($query, array $fillters) {

        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', '%'. $search. '%')
                ->orWhere('email', 'like', '%'. $search. '%')
                ->orWhere('id', 'like', '%'. $search. '%');
            })->orWhereHas('device', function($query) use ($search) {
                $query->where('name', 'like', '%'. $search. '%')
                ->orWhere('address', 'like', '%'. $search. '%')
                ->orWhere('id', 'like', '%'. $search. '%');
            });

        });

        $query->when($fillters['role'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('role', $search);
            });
        });


    }
}
