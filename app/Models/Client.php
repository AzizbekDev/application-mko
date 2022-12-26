<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'application_id',
        'status_app_id',
        'client_code',
        'client_limit',
        'password',
        'lang',
        'date_pub',
        'print',
        'status_id',
        'status_message'
    ];

    // Relations
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function wallet(){
        return $this->hasOne(ClientWallet::class);
    }

    // Scopes
    public function scopeStatus($query, $status_id)
    {
        return $query->where('status_id', '=', $status_id);
    }

    public function scopeStatusApp($query, $status_id)
    {
        return $query->where('status_app_id', '=', $status_id);
    }

    // Getters
    public function getStatusAppNameAttribute()
    {
        $statues = ["New App", "Viewed App", "Approved App", "Rejected App", "Blocked App"];
        return $statues[$this->status_app_id];
    }
    public function getStatusNameAttribute(){
        $statues = ["New Client", "Wallet Opened", "Limit Opened", "Success Client", "Rejected Client", "Closed Client"];
        return $statues[$this->status_id];
    }
}
