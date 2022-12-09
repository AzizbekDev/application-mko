<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    public $table = 'loggers';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'url',
        'user_id',
        'request_body',
        'response',
    ];
}
