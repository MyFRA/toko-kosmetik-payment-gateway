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
        'counter',
        'enable_variants',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id', 'id');
    }

    public function discount()
    {
        return $this->hasOne('App\Models\Discount', 'product_id', 'id');
    }

    public function product_variants()
    {
        return $this->hasMany('App\Models\ProductVariant', 'product_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\ProductComment', 'product_id', 'id');
    }

    public function promo()
    {
        return $this->hasOne('App\Models\Promo', 'product_id', 'id');
    }
}
