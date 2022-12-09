<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiUser extends Model
{
    protected $fillable = [
        'name',
        'password',
        'token',
        'user_id',
        'token_valid_period',
        'is_active',
        'token_expires_at'
    ];
}
