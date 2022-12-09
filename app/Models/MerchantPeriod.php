<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantPeriod extends Model
{
    protected $connection= 'wallet_db';

    protected $table = 'merchant_periods';
}
