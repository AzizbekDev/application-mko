<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsokiClient extends Model
{
    protected $guarded = [];

    public function info(){
        return $this->hasOne(AsokiInfo::class);
    }
}
