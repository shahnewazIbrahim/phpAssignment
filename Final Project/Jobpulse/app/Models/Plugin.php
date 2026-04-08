<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Plugin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['normalized_slug'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getNormalizedSlugAttribute(): string
    {
        return $this->slug ?: Str::slug($this->name, '_');
    }
}
