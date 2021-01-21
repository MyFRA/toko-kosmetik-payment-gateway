<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesProduct extends Model
{
    protected $table = 'sales_products';

    protected $fillable = [
        'sales_id',
        'product_name', 
        'product_image_url', 
        'product_url', 
        'product_amount', 
        'product_discount_percent', 
        'product_price', 
        'product_price_after_discount', 
        'product_weight', 
        'product_variant', 
    ];
}
