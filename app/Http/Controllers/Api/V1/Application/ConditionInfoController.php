<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConditionInfoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('method')) {
                $method = get_method_name($request->get('method'));
                if(method_exists($this, $method)){
                    $respond = $this->$method($request);
                }else{
                    $respond = $this->responseError('10405', "'method' not found");
                }
            }else{
            $respond = $this->responseError('10406', "'method' is required");
        }
        return $respond;
    }
    public function appCondition(){
        return $this->responseSuccess('123', [
            "info_count" => 3,
            "info"       => [
                0 => [
                    "uz" => "Kredit olish uchun 22ga to'lgan va 65 yoshdan oshmagan O'zbekiston Respublikasi fuqorolari.",
                    "ru" => "Право на получение кредита имеют граждане Республики Узбекистан, достигшие 22-летнего возраста и не старше 65 лет.",
                    "en" => "Citizens of the Republic of Uzbekistan who have reached the age of 22 and are not older than 65 years are eligible for a loan."
                ],
                1 => [
                    "uz" => "Onlayn kredit \"UNIRED Virtual\" kartaga mablag' o'tkazish yo'li bilan beriladi.",
                    "ru" => "Онлайн кредит выдается путем перечисления денег на карту \"UNIRED Virtual\".",
                    "en" => "Online credit is issued by transferring money to \"UNIRED Virtual\" card."
                ],
                2 => [
                    "uz" => "Boshlang'ich 3mln so'mdan 26mln so'mgacha bo'lgan miqdorda limit ajratish.",
                    "ru" => "Выделение лимитов с первоначальных 3 млн сумов до 26 млн сумов.",
                    "en" => "Allocation of limits from the initial 3 million soums to 26 million soums."
                ],
            ]
        ]);
    }

    public function cardCondition(){
        return $this->responseSuccess('124', [
            "info_count" => 3,
            "info"       => [
                0 => [
                    "uz" => "",
                    "ru" => "Право на получение кредита имеют граждане Республики Узбекистан, достигшие 22-летнего возраста и не старше 65 лет.",
                    "en" => "Citizens of the Republic of Uzbekistan who have reached the age of 22 and are not older than 65 years are eligible for a loan."
                ],
                1 => [
                    "uz" => "Onlayn kredit UNIRED Virtual kartaga mablag' o'tkazish yo'li bilan beriladi.",
                    "ru" => "Онлайн кредит выдается путем перечисления денег на карту UNIRED Virtual.",
                    "en" => "Online credit is issued by transferring money to UNIRED Virtual card."
                ],
                2 => [
                    "uz" => "Boshlang'ich 3mln so'mdan 26mln so'mgacha bo'lgan miqdorda limit ajratish.",
                    "ru" => "Выделение лимитов с первоначальных 3 млн сумов до 26 млн сумов.",
                    "en" => "Allocation of limits from the initial 3 million soums to 26 million soums."
                ],
            ]
        ]);
    }
}
