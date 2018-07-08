<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shifts()
    {
        return $this->belongsToMany(Shift::class)->withTimestamps();
    }

    public function isAdmin()
    {
        return in_array($this->email, config('cgsched.admins'));
    }

    public function requests()
    {
        return $this->hasMany(UserRequest::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class)->withTimestamps();
    }
}
