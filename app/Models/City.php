<?php


namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo',
    ];

    protected $casts = [
        'photo' => 'string',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value; // Mempertahankan format asli input
        $this->attributes['slug'] = Str::slug($value);
    }

    public function gyms()
    {
        return $this->hasMany(Gym::class, 'city_id');
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
