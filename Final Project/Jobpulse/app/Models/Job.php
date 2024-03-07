<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['type','specialities','deadline','user_id'];

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
