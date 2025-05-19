<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'promotion_id',
        'guest_name',
        'guest_phone',
        'guest_email',
        'guest_id_number',
        'check_in_date',
        'check_out_date',
        'total_amount',
        'payment_method',
        'status',
 
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'booking_room')
                    ->withPivot(['price_per_night', 'nights', 'total_price']);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_service')
                    ->withPivot(['quantity', 'unit_price', 'total_price']);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getFormattedCheckInDateAttribute()
{
    return \Carbon\Carbon::parse($this->check_in_date)->format('d-m-Y');
}

public function getFormattedCheckOutDateAttribute()
{
    return \Carbon\Carbon::parse($this->check_out_date)->format('d-m-Y');
}



}