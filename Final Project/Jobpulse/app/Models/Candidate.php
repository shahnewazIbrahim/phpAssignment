<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'user_id',
        'address',
        'ssc',
        'hsc',
        'hons',
        'other_qualification',
    ];
}
