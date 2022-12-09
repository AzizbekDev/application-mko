<?php

namespace App\Models;

use http\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'key_app',
        'serial_number',
        'pin',
        'card_pan',
        'phone',
        'passport_image',
        'passport_image1',
        'passport_image2',
        'step',
        'partner_id',
        'partner_groups',
        'status_id',
        'status_message',
        'is_test'
    ];

    public static function boot() {
        parent::boot();
        static::created(function ($app) {
            $app->key_app = uniqid($app->id);
            $app->save();
        });
    }
    
    // Application Update Create Custom function
    public static function updateOrCreateApp($data){
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
    public function scopeCheckPassportSerial($query, $serial_number){
        return $query->where('serial_number',$serial_number);
    }

    // Single Scopes
    public function scopeGetPersonalInfoByKeyApp($query, $data){
        return $query->whereKeyApp($data['key_app'])->with('personal_info')->first();
    }

    // Relations
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function personal_info()
    {
        return $this->hasOne(PersonalInfo::class, 'pin', 'pin');
    }
}
