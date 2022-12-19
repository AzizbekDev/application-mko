<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryCard extends Model
{
    protected $fillable = [
        "card_number",
        "expire",
        "phone",
        "mask",
        "owner",
        "bank",
        "sms",
        "is_corporate",
        "card_type",
        "card_order"
    ];

    public function saveCardInfo($data){
        $keys = [
            'card_number'   => $data['card_number'],
            'expire'        => $data['card_expire']
        ];
        $record = self::where($keys)->latest()->first();
        if (!is_null($record)) {
            return tap($record)->update($data);
        } else {
            return self::create($data);
        }
    }
}
