<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'branch_id',
        'start',
        'description',
        'phone',
        'email',
        'address',
    ];
    
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function images()
    {
        return $this->hasMany(HotelImage::class);
    }
    
    public function getCoverImageAttribute()
    {
        return $this->images->first()?->image_url;  // Trả về URL hình ảnh đầu tiên
    }

    public function amenities()
{
    return $this->hasMany(HotelAmenity::class);
}



}