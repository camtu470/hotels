<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id', 'floor_id', 'name', 'price_per_night', 'type', 'status'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function images()
{
    return $this->hasMany(RoomImage::class);
}

public function getCoverImageAttribute()
{
    return $this->images->first()?->image_url;
}

public function amenities()
{
    return $this->hasMany(Amenity::class);
}
public function bookings()
{
    return $this->belongsToMany(Booking::class, 'booking_room');
}


}