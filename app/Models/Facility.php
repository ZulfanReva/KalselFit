<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail',
        'is_open',
        'about',
    ];

    public function gymFacilities()
    {
        return $this->hasMany(GymFacility::class, 'facility_id');
    }
}
