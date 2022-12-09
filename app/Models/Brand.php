<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $connection= 'wallet_db';

    public static function get(){
        return Brand::all();
    }

    public function merchant() {
        return $this->belongsTo(Merchant::class,'id', 'brand_id');
    }
}
