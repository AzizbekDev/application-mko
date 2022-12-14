<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Token extends Model
{
    protected $fillable = [
        'name',
        'access_token',
        'expires_in',
        'refresh_token',
        'active',
        'token_expires_at'
    ];

    public static function getToken($name){

        return self::whereName($name)->active()->orderBy('id', 'DESC')->first();
    }

    public static function createNew($name, $data){

        self::where(['name' => $name])
            ->update(['active' => false]);

        return self::create(
            array_merge([
                'name'             => $name,
                'token_expires_at' => Carbon::now()->addSeconds($data['expires_in'])
            ],$data));
    }

    public function scopeActive(){
        return $this->where('active', true);
    }
}
