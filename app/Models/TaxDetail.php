<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxDetail extends Model
{
    protected $fillable = [
        'tax_info_id',
        'company_name',
        'company_tin',
        'year',
        'period',
        'salary',
        'salary_tax_sum',
        'inps_sum',
        'prop_income',
        'other_income'
    ];
}
