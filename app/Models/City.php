<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'province_id', 'city_name'];

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'id');
    }
}
