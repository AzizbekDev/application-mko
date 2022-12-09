<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $connection= 'wallet_db';

    public function brand(){
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }

    public function periods(){
        return $this->hasMany(MerchantPeriod::class, 'id', 'merchant_id')->select('id','period','percentage')->where('status',1);
    }
}
