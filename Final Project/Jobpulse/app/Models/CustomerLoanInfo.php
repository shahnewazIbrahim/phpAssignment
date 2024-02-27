<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLoanInfo extends Model
{
    use HasFactory;
    protected $fillable = ['loan_id', 'customer_id', 'key', 'value'];
}
