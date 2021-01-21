<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesAddress extends Model
{
    protected $table = 'sales_address';

    protected $fillable = [
        'sales_id',
        'address_name', 
        'customer_name', 
        'number_phone', 
        'province', 
        'city', 
        'postal_code', 
        'full_address', 
    ];
}
