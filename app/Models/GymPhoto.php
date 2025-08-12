<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'gym_id',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}
