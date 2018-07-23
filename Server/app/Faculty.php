<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'initials', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
