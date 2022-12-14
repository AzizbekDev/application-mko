<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardScoringInfo extends Model
{
    protected $fillable = [
        'salary_card_id',
        'salary_average',
        'min_limit',
        'max_limit',
        'response_info',
        'status_id',
        'status_message'
    ];
}
