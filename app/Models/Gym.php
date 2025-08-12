<?php


namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'city_id',
        'open_time_at',
        'closed_time_at',
        'is_popular',
        'address',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function gymPhotos()
    {
        return $this->hasMany(GymPhoto::class, 'gym_id');
    }

    public function gymFacilities()
    {
        return $this->hasMany(GymFacility::class, 'gym_id');
    }

    public function gymTestimonials()
    {
        return $this->hasMany(GymTestimonial::class, 'gym_id');
    }
}
