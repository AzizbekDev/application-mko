<?php
namespace App\Traits\Personal;

use App\Models\PersonalInfo;
use App\Http\Resources\Application\PersonalInfoResource;

trait CheckPerson{
    static $params = ["pin" => true, "serial_number" => true];
    public function checkPerson($data){
        // array_intersect_key — Вычислить пересечение массивов, сравнивая ключи
        // array_filter — Фильтрует элементы массива с помощью callback-функции
        $data = array_filter(array_intersect_key($data, self::$params));
        if($data && (array_key_exists('pin', $data))){
            $info = PersonalInfo::pin($data['pin']);
            if($info->exists()) return new PersonalInfoResource($info->first());
        }elseif($data && array_key_exists('serial_number', $data)){
            $info = PersonalInfo::serialNumber($data['serial_number']);
            if($info->exists()) return new PersonalInfoResource($info->first());
        }
        return false;
    }
}