<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxInfo extends Model
{
    protected $fillable = [
        'name',
        'tin',
        'pinfl',
        'serial_number',
        'ns10_code',
        'ns11_code',
        'last_year',
        'last_period',
        'average_salary',
        'status_id',
        'status_message'
    ];

    // Model Relations
    public function details(){
        return $this->hasMany(TaxDetail::class);
    }
}
