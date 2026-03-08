<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];
}