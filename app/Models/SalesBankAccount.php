<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesBankAccount extends Model
{
    protected $table = 'sales_bank_accounts';

    protected $fillable = [
        'sales_id',
        'bank_name',
        'bank_logo',
        'bank_account_name',
        'bank_account_number',
    ];
}
