<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsokiInfo extends Model
{
    protected $guarded = [];

    public function asokiClient(){
        return $this->belongsTo(AsokiClient::class);
    }
}
