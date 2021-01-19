<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'customer_id', 
        'product_name', 
        'product_image_url', 
        'product_url', 
        'product_amount', 
        'product_discount_percent', 
        'product_price', 
        'product_price_after_discount', 
        'product_weight', 
        'product_variant', 
        'address_name', 
        'customer_name', 
        'number_phone', 
        'province', 
        'city', 
        'postal_code', 
        'full_address', 
        'type_expedition', 
        'price_expedition', 
        'estimation_expedition', 
        'desc_expedition', 
        'price_total_payment', 
        'product_weight_total',
        'bank_name',
        'bank_logo',
        'bank_account_name',
        'bank_account_number',
        'proof_of_payment', 
        'status'
    ];
}
