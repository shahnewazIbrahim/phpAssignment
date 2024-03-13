<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use HasFactory;
    // protected $fillable = ['type','specialities','deadline','user_id'];
    protected $guarded = [];

    protected $appends = [
        'is_applied_by_user'
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function applyJobs()
    {
        return $this->hasMany(ApplyJob::class);
    }
    function getIsAppliedByUserAttribute()
    {
        return $this->applyJobs()->where(['job_id'=> $this->id, 'user_id' => Auth::id()])->exists();
    }
}
