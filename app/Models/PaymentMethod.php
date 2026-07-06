<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'table_payment_method';

    protected $fillable = [
        'metode_payment',
        'logo',
        'is_active',
    ];
}
