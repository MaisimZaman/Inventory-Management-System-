<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'license_plate',
        'status',
        'rental_price_per_day',
        'description',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
        }

    // (Optional) You could add helper functions or relationships later here
}
