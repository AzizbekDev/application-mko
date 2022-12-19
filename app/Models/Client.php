<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'application_id',
        'status_app_id',
        'client_code',
        'password',
        'lang',
        'date_pub',
        'print',
        'status_id',
        'status_message'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function wallet(){
        return $this->hasOne(ClientWallet::class);
    }

    public function scopeStatusApp($query, $status_id)
    {
        return $query->where('status_app_id', '=', $status_id);
    }
}
