<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'address', 'phone', 'lat_long', 'description', 'website', 'is_verif', 'status', 'user_id', 'location_type_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type()
    {
        return $this->hasOne(LocationType::class, 'id', 'location_type_id');
    }

    public function images()
    {
        return $this->hasMany(LocationImage::class, 'location_id', 'id');
    }
}
