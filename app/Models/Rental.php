<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',              // ✅ Add this
        'customer_name',
        'rental_start_date',
        'rental_end_date',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
