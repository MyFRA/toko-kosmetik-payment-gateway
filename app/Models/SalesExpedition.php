<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesExpedition extends Model
{
    protected $table = 'sales_expeditions';

    protected $fillable = [
        'sales_id',
        'type_expedition', 
        'price_expedition', 
        'estimation_expedition', 
        'desc_expedition', 
    ];
}
