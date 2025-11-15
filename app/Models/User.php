<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function pickups()
    {
        return $this->hasMany(Pickup::class);
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function distributions()
    {
        return $this->hasMany(Distribution::class);
    }

    public function posts()
    {
        return $this->hasMany(EducationalPost::class);
    }
}
