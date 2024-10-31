<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_date',
        'location_id',
    ];
    public function seatAllocations()
    {
        return $this->hasMany(SeatAllocation::class);
    }
}
