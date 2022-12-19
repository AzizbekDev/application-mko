<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardMonitoringInfo extends Model
{
    protected $fillable = [
        'salary_card_id',
        'salary_average',
        'total_credit',
        'total_debit',
        'start_date',
        'end_date',
        'response_info',
        'status'
    ];
}
