<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymTestimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'occupation',
        'message',
        'photo',
        'gym_id',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id');
    }
}
