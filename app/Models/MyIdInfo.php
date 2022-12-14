<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyIdInfo extends Model
{
    protected $fillable = [
        'full_name',
        'pass_data',
        'pinfl',
        'is_mobile',
        'response_id',
        'job_id',
        'comparison_value',
        'result_code',
        'result_note',
        'profile'
    ];

    public static function saveProfile($data){
        if(is_array($data) && array_key_exists('result_code',$data) && array_key_exists('response_id',$data)){
            $keys = [
                'job_id' => $data['response_id']
            ];
            $record = self::where($keys)->latest()->first();
            if(!is_null($data['profile'])){
                $fillData = [
                    'full_name'        => $data['profile']['common_data']['last_name'].' '.$data['profile']['common_data']['first_name'].' '.$data['profile']['common_data']['middle_name'],
                    'response_id'      => $data['response_id'],
                    'comparison_value' => $data['comparison_value'],
                    'result_code'      => $data['result_code'],
                    'result_note'      => $data['result_note'],
                    'profile'          => json_encode($data['profile'])
                ];
                return tap($record)->update($fillData);
            }
            return tap($record)->update($data);
        }
    }
}
