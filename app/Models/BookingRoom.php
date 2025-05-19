<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory;

    protected $table = 'booking_room'; // tên bảng pivot

    public $timestamps = false; // bảng này không cần timestamps

    protected $fillable = [
        'booking_id',
        'room_id',
        'price_per_night',
        'nights',
        'total_price',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}