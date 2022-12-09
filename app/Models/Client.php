<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'application_id',
        'bank_mfo',
        'client_code',
        'password',
        'lang',
        'print',
        'date_pub',
        'status_id',
        'status_message'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
