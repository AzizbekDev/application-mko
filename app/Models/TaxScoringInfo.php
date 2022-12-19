<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxScoringInfo extends Model
{
    protected $fillable = [
        'tax_info_id',
        'salary_average',
        'min_limit',
        'max_limit',
        'response_info',
        'status_id',
        'status_message'
    ];
}
