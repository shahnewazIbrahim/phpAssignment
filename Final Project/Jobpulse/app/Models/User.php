<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = ['firstName', 'lastName', 'email', 'mobile', 'password', 'otp', 'type'];
    protected $attributes = ['otp' => '0'];
    protected $hidden = ['password', 'otp'];
    protected $appends = ['full_name'];

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'user_roles');
    // }

    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function candidate(): HasOne
    {
        return $this->hasOne(Candidate::class);
    }
    public function applyJob(): HasMany
    {
        return $this->hasMany(ApplyJob::class);
    }
    public function plugins(): HasMany
    {
        return $this->hasMany(Plugin::class);
    }
    public function getFullNameAttribute()
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function hasActivePlugin(string $slug): bool
    {
        if ($this->hasRole('Owner')) {
            return true;
        }

        $normalizedSlug = Str::slug($slug, '_');

        return $this->plugins
            ->where('active', 1)
            ->contains(function ($plugin) use ($normalizedSlug) {
                $currentSlug = $plugin->slug ?: Str::slug($plugin->name, '_');
                return $currentSlug === $normalizedSlug;
            });
    }
}
