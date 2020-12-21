<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 
        'product_slug', 
        'product_category_id', 
        'price', 
        'weight', 
        'amount', 
        'condition', 
        'product_images', 
        'description', 
        'sold', 
        'counter'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id', 'id');
    }
}
