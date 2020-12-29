<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductComment extends Model
{
    protected $fillable = ['customer_id', 'product_id', 'comment'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    public function getCreatedAtAttributes($date, $format)
    {
        if($format == 'diffForHumans') {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
        }
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
    }
}
