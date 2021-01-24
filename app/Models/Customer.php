<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullname', 'email', 'password', 'email_verified_at', 'photo', 'email_verification_token', 'status'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customerDetail() {
        return $this->hasOne('App\Models\CustomerDetail', 'customer_id', 'id');
    }

    public function customerAddress() {
        return $this->hasMany('App\Models\CustomerAddress', 'customer_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart', 'customer_id', 'id');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist', 'customer_id', 'id');
    }
}
