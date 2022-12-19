<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientWallet extends Model
{
    protected $fillable = [
        'client_id',
        'owner',
        'card_number',
        'card_expire',
        'phone',
        'token',
        'balance',
        'status'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
