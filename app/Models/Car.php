<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $table = 'cars';
    protected $fillable = [
        'name',
        'model',
        'description',
        'image'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
