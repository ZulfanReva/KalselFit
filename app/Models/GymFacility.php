<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_id',
        'facility_id',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }
}
