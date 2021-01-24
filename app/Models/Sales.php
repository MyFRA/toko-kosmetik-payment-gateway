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
        'bank_sender_account_name',
        'start_payment_date',
        'limit_payment_date',
        'status',
        'amount_total',
    ];

    public function bank()
    {
        return $this->hasOne('App\Models\SalesBankAccount', 'sales_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\SalesProduct', 'sales_id', 'id');
    }

    public function expedition()
    {
        return $this->hasOne('App\Models\SalesExpedition', 'sales_id', 'id');
    }
}
