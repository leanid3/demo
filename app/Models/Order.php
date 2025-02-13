<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'booking_date',
        'car_id',
        'status',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
    public function car(): BelongsTo
    {
        return  $this->belongsTo(Car::class);
    }
}
