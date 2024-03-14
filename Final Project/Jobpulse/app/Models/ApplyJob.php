<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ApplyJob extends Model
{
    use HasFactory;
    protected $fillable= ['job_id', 'user_id', 'accept'];
    protected $appends= ['can_accept'];
    /**
     * Get the user that owns the ApplyJob
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
     
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     
    public function getCanAcceptAttribute()    {
        return Auth::id()?  in_array('Company',  User::find(Auth::id())->roles->pluck('name')->toArray()) : false;
    }
}
