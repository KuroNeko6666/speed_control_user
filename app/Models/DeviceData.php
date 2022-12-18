<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{
    use HasFactory;
    protected $table = 'device_data';

    protected $guarded = ['id'];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    public function scopeFilter($query, array $fillters) {

        $query->when($fillters['search'] ?? false, function ($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('device_id', 'like', '%'. $search. '%')
                ->orWhere('speed', 'like', '%'. $search. '%')
                ->orWhere('distance', 'like', '%'. $search. '%')
                ->orWhere('id', 'like', '%'. $search. '%');

            })->orWhereHas('device', function($query) use ($search) {
                $query->where('name', 'like', '%'. $search. '%')
                ->orWhere('address', 'like', '%'. $search. '%')
                ->orWhere('id', 'like', '%'. $search. '%');
            });
        });

        $query->when($fillters['device_id'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('device_id', $search);
            });
        });

    }

}
