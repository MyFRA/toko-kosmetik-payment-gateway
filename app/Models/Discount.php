<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['product_id', 'end_date', 'forever', 'discount_percent'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
