<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table    = 'applications';

    protected $fillable = [
        'key_app',
        'serial_number',
        'pin',
        'card_mask',
        'phone',
        'step',
        'partner_id',
        'status_id',
        'status_message',
        'is_identified',
        'is_test'
    ];

    // Application Update Create Custom function
    public static function updateOrCreateApp($data)
    {
        $keys = [
            'serial_number' => $data['serial_number'],
            'pin'           => $data['pin']
        ];
        $record = self::where($keys)->latest()->first();
        if (!is_null($record)) {
            return tap($record)->update($data);
        } else {
            return self::create($data);
        }
    }

    // Universal Scopes
    public function scopeStatus($query, $status_id)
    {
        return $query->where('status_id', '=', $status_id);
    }

    public function scopeCheckPassportSerial($query, $serial_number)
    {
        return $query->where('serial_number',$serial_number);
    }
    
    // Single Scopes
    public function scopeGetPersonalInfoByKeyApp($query, $data)
    {
        return $query->whereKeyApp($data['key_app'])->with('personal_info')->first();
    }

    // Relations
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function tax()
    {
        return $this->hasOne(TaxInfo::class);
    }

    public function applicationInfo()
    {
        return $this->hasOne(ApplicationInfo::class);
    }

    public function salaryCards()
    {
        return $this->hasMany(SalaryCard::class);
    }

    public function partnerInfo()
    {
        return $this->hasOne(ApiUser::class, 'id', 'partner_id');
    }

    public function asokiClient(){
        return $this->hasOne(AsokiClient::class, 'claim_id', 'id');
    }
//    public function personalInfo()
//    {
//        return $this->hasOne(PersonalInfo::class, 'pin', 'pin');
//    }
}
