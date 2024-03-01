<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $fillable = ['firstName', 'lastName', 'email', 'mobile', 'password', 'otp'];
    protected $attributes = ['otp' => '0'];
    protected $hidden = ['password', 'otp'];

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'user_roles');
    // }
}
