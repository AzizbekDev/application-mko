<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $table = 'personal_infos';

    protected $fillable = [
        'serial_number',
        'pin',
        'inn',
        'birth_date',
        'document_date',
        'document_region',
        'document_district',
        'family_name',
        'name',
        'patronymic',
        'registration_region',
        'registration_district',
        'registration_address',
        'live_address',
        'gender',
        'status_id',
        'status_message',
        'response_source',
        'response_info',
        'person_photo'
    ];

    public function scopePin($query, $pin)
    {
        return $query->where('pin', '=', $pin);
    }

    public function scopeSerialNumber($query, $serial_number)
    {
        return $query->where('serial_number', '=', $serial_number);
    }

    public static function updateOrCreatePerson($data){
        $keys = [
            'serial_number' => $data['serial_number'],
            'pin'           => $data['pin']
        ];
        $record = self::where($keys)->first();
        if (!is_null($record)) {
            return tap($record)->update($data);
        } else {
            return self::create($data);
        }
    }
}
