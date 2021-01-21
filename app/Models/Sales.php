<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'customer_id', 
        'weight_total',
        'price_total',
        'proof_of_payment',
        'start_payment_date',
        'limit_payment_date',
        'status'
    ];
}
