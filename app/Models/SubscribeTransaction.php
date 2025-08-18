<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'booking_trx_id',
        'proof',
        'total_amount',
        'started_at',
        'ended_at',
        'duration',
        'subscribe_package_id',
        'is_paid',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at'   => 'datetime',
    ];

    public function subscribePackage()
    {
        return $this->belongsTo(SubscribePackage::class, 'subscribe_package_id');
    }

    public static function generateUniqueTrxId()
    {
        $prefix = 'FITKALSEL'; // FITKALSEL123

        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }
}
