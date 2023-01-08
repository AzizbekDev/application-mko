<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsokiClient extends Model
{
    protected $guarded = [];

    public function info(){
        return $this->hasOne(AsokiInfo::class);
    }

    public function getFullNameAttribute()
    {
        return $this->family_name .' '.$this->name.' '.$this->patronymic;
    }

    public function getStatusNameAttribute()
    {
        $statues = [
            1 => "New Client",
            2 => "Success Info",
            3 => "Error",
            4 => "Rejected Client"
        ];
        return $statues[$this->status_id];
    }
}
