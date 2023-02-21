<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'Supplier_name',
        'Bill_number',
        'Amount',
        'Bill_date',
        'Deposit_date',
        'Service_name'
    ];
}
