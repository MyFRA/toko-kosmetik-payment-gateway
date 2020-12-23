<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = ['fullname', 'email', 'password', 'number_phone'];
    protected $hidden = ['password'];
}
