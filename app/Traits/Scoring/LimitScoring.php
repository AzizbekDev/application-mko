<?php
namespace App\Traits\Scoring;

use Carbon\Carbon;

trait LimitScoring
{
    static $min_limit     = 3000000;
    static $max_limit     = 26000000;
    public function get_limit($avarage_salary, $birth_day){
        $age   = Carbon::parse($birth_day)->age;
        $limit = 0;
        if($avarage_salary != 0){
            $limit      = intval($avarage_salary * 6 / 2);
            if(self::$max_limit < $limit){
                $limit = self::$max_limit;
            }
            if($age <= 22){
                $limit = $limit *0.5;
            }elseif($age == 23){
                $limit = $limit *0.6;
            }elseif($age == 24){
                $limit = $limit *0.7;
            }elseif($age == 25){
                $limit = $limit *0.8;
            }elseif($age == 26){
                $limit = $limit *0.9;
            }else{
                $limit = $limit * 1;
            }
        }
        return intval($limit/100000)*100000;
    }
}