<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table= 'bank_accounts';
    protected $fillable = ['bank_name', 'bank_logo', 'bank_account_name', 'bank_account_number'];
}
