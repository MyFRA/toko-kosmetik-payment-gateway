<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = ['category_name', 'slug', 'image_category'];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'product_category_id', 'id');
    }
}
