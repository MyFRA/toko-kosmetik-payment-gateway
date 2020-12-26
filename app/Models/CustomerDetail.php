<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    protected $table = 'customer_detail';
    
    protected $fillable = ['customer_id', 'number_phone', 'gender', 'birth'];
}
