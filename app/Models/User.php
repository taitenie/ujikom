<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'email',
        'birth',
        'gender',
        'address',
        'city',
        'number',
        'paypalId',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
