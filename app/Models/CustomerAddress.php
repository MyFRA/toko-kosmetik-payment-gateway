<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer_address';

    protected $fillable = ['customer_id', 'address_name', 'customer_name', 'number_phone', 'province', 'city', 'postal_code', 'full_address', 'main_address'];
}
