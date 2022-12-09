<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Setting extends Model
{
    public $table = 'settings';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'description',
        'value',
        'status',
        'created_at',
        'updated_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeGetValueSettingByName($query, $name){
        return $query->whereName($name)->first()->value;
    }

    public static function updateSettingByName($name,$data){
        $record = self::where(['name' => $name])->first();
        if (!is_null($record)) {
            return tap($record)->update($data);
        }
        return false;
    }
}
