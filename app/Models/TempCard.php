<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TempCard extends Model
{
    use SoftDeletes;
    const STATUS_NEW          = 0;
    const STATUS_OTP_SENT     = 1;
    const STATUS_SUCCESS      = 2;
    const STATUS_OTP_EXPIRED  = 3;
    const STATUS_DISMISSED    = 4;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y h:i:s',
        'updated_at' => 'datetime:d-m-Y h:i:s',
        'deleted_at' => 'datetime:d-m-Y h:i:s'
    ];

    protected $fillable = [
        'temp_type',
        'holder_name',
        'card_number',
        'card_expire',
        'phone',
        'amount',
        'otp',
        'status_id',
        'status_message'
    ];

    protected static function boot() {

        parent::boot();
        static::created(function ($model) {
            $model->otp = quick_random(5,true);
            $model->save();
        });
        static::updating(function ($model) {
            $model->status_message = self::getStatusMessage($model->status_id);
        });
    }


    public static function createTempCard($data){
        $keys = [
            'card_number'  => $data['card_number'],
            'card_expire'  => $data['card_expire']
        ];
        $record = self::where($keys)->latest()->first();
        if(!is_null($record) && $record->status_id != self::STATUS_SUCCESS){
            if(self::checkOtpIsExpired($record) == false) $data['otp'] = quick_random(5,true);
            return tap($record)->update($data);
        }else{
            return self::create($data);
        }
    }

    public function updateStatus($status_id){
        return self::update([
            'status_id' => $status_id,
            'status_message' => self::getStatusMessage($status_id)
        ]);
    }

    public static function getStatusMessage($status_id){
        switch ($status_id){
            case static::STATUS_OTP_SENT:
                $status_message = 'OTP was send';
                break;
            case static::STATUS_SUCCESS:
                $status_message = 'Success confirmed';
                break;
            case static::STATUS_OTP_EXPIRED:
                $status_message = 'OTP expired';
                break;
            case static::STATUS_DISMISSED:
                $status_message = 'Dismissed';
                break;
            default:
                $status_message = 'New application';
                break;
        }
        return $status_message;
    }

    public static function checkOtpIsExpired($record){
        return  (Carbon::now()->diffInMinutes($record->updated_at) <= 1) ? true : false;
    }
}
