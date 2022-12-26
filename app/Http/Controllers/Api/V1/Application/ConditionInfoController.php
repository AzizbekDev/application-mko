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
            "description"=> [
                "uz" => "UNIRED virtual kartasi olish uchun ariza topshiring va 3mln dan 26mln so'mgacha mablag'ni qisqa muddat ichida oling.",
                "ru" => "Оформите виртуальную карту UNIRED и получите средства от 3 млн до 26 млн сумов за короткий срок.",
                "en" => "Apply for a UNIRED virtual card and get funds from 3 million to 26 million soums in a short period of time."
            ],
            "conditions_count" => 3,
            "conditions"       => [
                0 => [
                    "uz" => "Kredit olish uchun 22ga to'lgan va 65 yoshdan oshmagan O'zbekiston Respublikasi fuqorolari.",
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
            ],
            'limit'            => [
                'min'          => 3000000,
                'max'          => 26000000
            ]
        ]);
    }

    public function cardCondition(){
        return $this->responseSuccess('124', [
            "description"=> [
                "uz" => "Kredit limiti mijozning scoring balli asosida quyidagi shartlarga ko'ra belgilanadi.",
                "ru" => "Кредитный лимит определяется на основании скоринга клиента в соответствии со следующими условиями.",
                "en" => "The credit limit is determined based on the customer's scoring point according to the following conditions."
            ],
            "conditions_count" => 4,
            "conditions"       => [
                0 => [
                    "uz" => "O'rtacha oylik maosh oxirgi 6 oy mobaynida 2mln so'mdan kam bo'lmasligi kerak.",
                    "ru" => "Среднемесячная заработная плата за последние 6 месяцев должна быть не менее 2 млн сумов.",
                    "en" => "The average monthly salary during the last 6 months should not be less than 2 million soums."
                ],
                1 => [
                    "uz" => "Qarz yuki ko'rsatkichi, ya'ni qarz oluvchining barcha kredit va kafilliklari bo'yicha o'rtacha oylik to'lovlari migdorining o'rtacha oylik daromadiga nisbati 50% yuqori bo'lmasligi.",
                    "ru" => "Показатель долговой нагрузки, то есть отношение среднемесячных платежей заемщика по всем кредитам и гарантиям к среднемесячному доходу, не должен быть выше 50%.",
                    "en" => "The debt burden indicator, that is, the ratio of the borrower's average monthly payments for all loans and guarantees to the average monthly income should not be higher than 50%."
                ],
                2 => [
                    "uz" => "Daromadlar to'g'risidagi hujjatlar (MKO platformasi tomonidan Crobs dasturi orqali elektron ma'lumotlar olinadi).",
                    "ru" => "Документы о доходах (электронная информация поступает на платформу МКО через программу Crobs)",
                    "en" => "Income documents (electronic information is received by the MKO platform through the Crobs program)."
                ],
                3 => [
                    "uz" => "Mijozning so'ndirilmagan maqsadsiz onlayn krediti mavjud yoki avval olingan kreditlari bo'yicha muddati o'tgan qarzdorligi mavjud bo'lsa rasmiylashtirilmaydi.",
                    "ru" => "Клиент не будет очищен, если у него есть неистекший онлайн-кредит или есть задолженность по предыдущим кредитам.",
                    "en" => "The customer will not be cleared if he has an unexpired online loan or is in arrears on previous loans."
                ],
            ]
        ]);
    }
}
