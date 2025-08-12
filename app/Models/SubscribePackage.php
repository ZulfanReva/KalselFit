<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'price',
        'duration',
    ];

    public function subscribeBenefit()
    {
        return $this->hasMany(SubscribeBenefit::class, 'subscribe_package_id');
    }

    public function subscribeTransaction()
    {
        return $this->hasMany(SubscribeTransaction::class, 'subscribe_package_id');
    }
}
