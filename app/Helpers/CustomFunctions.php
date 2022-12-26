<?php

if (!function_exists('decimal_price_format')) {
    function decimal_price_format($price)
    {
        if(is_object($price)) return 0;
        return number_format((int)$price / 100, 0, ",", ".");
    }
}

if (!function_exists('price_format')) {
    function price_format($price)
    {
        return number_format((int)$price, 0, ",", " ");
    }
}

if (!function_exists('get_method_name')) {
    function get_method_name($method, $capitalizeFirstCharacter = false)
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $method)));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }
}

if (!function_exists('snake_to_camel_case')) {
    function snake_to_camel_case($string, $capitalizeFirstCharacter = false)
    {
        $str = ucwords(str_replace('_', ' ', $string));
        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }
        return $str;
    }
}

if (!function_exists('camel_to_snake')) {
    function camel_to_snake($string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}

if (!function_exists('snake_to_camel')) {
    function snake_to_camel($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }
}

if (!function_exists('extract_passport_seria')) {
    function extract_passport_seria($serialNumber)
    {
        return substr($serialNumber, 0, 2);
    }
}

if (!function_exists('extract_passport_number')) {
    function extract_passport_number($serialNumber)
    {
        return substr($serialNumber, 2, 7);
    }
}

if (!function_exists('extract_passport_birth_date')) {
    function extract_passport_birth_date($pinpp)
    {
        if(isset($pinpp) && strlen($pinpp) == 14){
            $day    = substr($pinpp, 1,2);
            $month  = substr($pinpp, 3,2);
            $period = substr($pinpp, 0,1);
            if($period == 3 || $period == 4){
                $year   = '19'.substr($pinpp, 5,2);
                return $day.'.'.$month.'.'.$year;
            }
            if($period == 5 || $period == 6){
                $year   = '20'.substr($pinpp, 5,2);
                return $day.'.'.$month.'.'.$year;
            }
        }
        return null;
    }
}

if (!function_exists('extract_passport_gender')) {
    function extract_passport_gender($pinpp)
    {
        if(isset($pinpp) && strlen($pinpp) == 14){
            $gender_type = substr($pinpp, 0,1);
            if($gender_type == 3 || $gender_type == 5) return 1; // Male
            if($gender_type == 4 || $gender_type == 6) return 2; // Female
        }
        return 0;
    }
}

if (!function_exists('extract_full_name')) {
    function extract_full_name($full_name, $keys = ['family_name', 'name', 'patronymic'])
    {
        $values = explode(' ', $full_name);
        return array_combine($keys, $values);
    }
}

if (!function_exists('date_format_store')) {
    function date_format_store($date)
    {
        return Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}

if (!function_exists('date_local_format')) {
    function date_local_format($date)
    {
        $date = new DateTime($date, new DateTimeZone('UTC'));
        $date->setTimezone(new DateTimeZone('Asia/Tashkent'));
        return $date->format('Y-m-d H:i');
    }
}

if (!function_exists('get_code_message')) {
    function get_code_message($code, $lang = 'uz')
    {
        $codes = [
            '10000' => [
                'uz' => 'Bunday zayafka mavjud!',
                'ru' => 'Заявка уже есть!',
                'en' => 'Such an application is available!'
            ],
            '10100' => [
                'uz' => 'Passport ma\'lumotlari saqlandi!',
                'ru' => 'Паспортная информация сохранена!',
                'en' => 'Passport information is saved!'
            ],
            '10111' => [
                'uz' => 'Tug\'ilgan sanasi mos kelmadi!',
                'ru' => 'Дата рождения не совпадает!',
                'en' => 'Date of birth did not match!'
            ],
            '10113' => [
                'uz' => 'Passport ma\'lumotlari topilmadi!',
                'ru' => 'Паспортная информация не найдена!',
                'en' => 'Passport information not found!'
            ],
            '20100' => [
                'uz' => 'Passport ma\'lumotlari mavjud!',
                'ru' => 'Паспортная информация доступна!',
                'en' => 'Passport information is available!'
            ],
            '20101' => [
                'uz' => 'Passport ma\'lumotlari saqlandi!',
                'ru' => 'Паспортная информация сохранена!',
                'en' => 'Passport information saved!'
            ],
            '30101' => [
                'uz' => 'Kartada yetarlicha mablag\' mavjud emas!',
                'ru' => 'There is not enough money on the card!',
                'en' => 'На карте недостаточно денег!'
            ],
            '30102' => [
                'uz' => 'Karta holati faol emas!',
                'ru' => 'Статус карты не активен!',
                'en' => 'Card status is not active!'
            ],
            '30103' => [
                'uz' => 'Korporativ kartalar qabul qilinmaydi!',
                'ru' => 'Корпоративных карт не принимаются!',
                'en' => 'Corporate cards are not accepted!'
            ],
            '30104' => [
                'uz' => 'Kartaga telefon raqam noto\'g\'ri ulangan!',
                'ru' => 'Номер телефона неправильно привязан к карте!',
                'en' => 'The phone number is incorrectly connected to the card!'
            ],
            '30105' => [
                'uz' => 'Kartaga bo\'g\'langan telefon raqam kiritilgan raqam bilan mos kelmadi!',
                'ru' => 'Номер телефона, прикрепленный к карте, не соответствует введенному номеру!',
                'en' => 'The phone number attached to the card did not match the number entered!'
            ],
            '30106' => [
                'uz' => 'Karta raqami noto\'g\'ri!',
                'ru' => 'Номер карты неверный!',
                'en' => 'The card number is incorrect!'
            ],
            '30107' => [
                'uz' => 'Karta scoringdan o\'tmadi! To\'liqroq ma\'lumot uchun call-centerga murojaat qiling +998(71)200-11-10!',
                'ru' => 'Карта не прошла от скориг! За дополнительной информацией обращайтесь в колл-центр +998(71)200-11-10!',
                'en' => 'The card did not pass from the scorig! For more information contact the call center +998(71)200-11-10!'
            ],
            '30108' => [
                'uz' => 'Serverda xatolik bor boshqatdan urunib ko\'ring!',
                'ru' => 'На сервере произошла ошибка, попробуйте еще раз!',
                'en' => 'An error occurred on the server, please try again!'
            ],
            '30109' => [
                'uz' => 'Karta scoringdan o\'tmadi!',
                'ru' => 'Карта не прошла  от скориг!',
                'en' => 'The card did not go through scoring!'
            ],
            '30110' => [  // sariq
                'uz' => 'Ariza ko\'rib chiqishga tavfsiya etildi!',
                'ru' => 'Заявка была рекомендована к рассмотрению!',
                'en' => 'The application was recommended for consideration!'
            ],
            '30111' => [ // qizil
                'uz' => 'Ariza kredit tarixi sababli rad etildi!',
                'ru' => 'Заявка отклонена из-за кредитной истории!',
                'en' => 'The application was rejected due to credit history!!'
            ],
            '30112' => [ // yashil
                'uz' => 'Arizangiz ma\'qullandi!',
                'ru' => 'Ваша заявка одобрена!',
                'en' => 'Your application has been approved!'
            ],
            '60102' => [
                'uz' => 'Ariza topilmadi!',
                'ru' => 'Заявка не найдено!',
                'en' => 'Application wasn\'t found!'
            ],
            '90101' => [
                'uz' => 'Passport ma\'lumotlari topilmadi!',
                'ru' => 'Паспортная информация не найдена!',
                'en' => 'Passport information not found!'
            ],
            '90102' => [
                'uz' => 'Passport ma\'lumotlari mavjud!',
                'ru' => 'Паспортная информация доступна!',
                'en' => 'Passport information is available!'
            ],


        ];


        return $codes[$code][$lang];
    }
}

if (!function_exists('extract_client_code')) {
    function extract_client_code($code)
    {
        $client_code = substr($code, 16, 8);
        return $client_code;
    }
}

if (!function_exists('quick_random')) {
    function quick_random($length = 16, $only_numbers = false)
    {
        if($only_numbers){
            $pool = '0123456789';
        }else{
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}

if (!function_exists('create_guid')) {
    function create_guid()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);
            $charid = md5(uniqid(rand(), true));
            $hyphen = chr(45);
            $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);
            return $uuid;
        }
    }
}

if (!function_exists('findPassValueByKey')) {
    function findPassValueByKey($find_key, $info)
    {
        $decode = json_decode($info, true);

        foreach ($decode as $key => $value) {
            if (is_array($value)) {
                if (array_key_exists($find_key, $value)) {
                    if (!is_array($value[$find_key]))
                        return $value[$find_key];
                }
                foreach ($value as $sub_key => $sub_value) {
                    if (is_array($sub_value)) {
                        if (array_key_exists($find_key, $sub_value)) {
                            return $sub_value[$find_key];
                        }
                    }
                }
            }
        }
        return;
    }
}
if (!function_exists('convert_text_latin')) {
    function convert_text_latin($text)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ў', 'ф', 'ғ', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ў', 'Ф', 'Ғ', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'j', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'o', 'f', 'g', 'h', 'ts', 'ch', 'sh', 'sh', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'J', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'O', 'F', 'G', 'H', 'Ts', 'Ch', 'Sh', 'Sh', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
        ];
        $textlat = mb_strtoupper(removeChars(str_replace($cyr, $lat, $text)));
        return $textlat;
    }
}

if (!function_exists('removeChars')) {
    function removeChars($value)
    {
        $title = str_replace(array('\'', '"', ',', ';', '.', '’','-','‘','/','"""'), ' ', $value);
        return $title;
    }
}

if (!function_exists('removeMarks')) {
    function removeMarks($value)
    {
        $title = str_replace(array('\'', '’','‘','`','?','\'', '"', ',', ';', '.', '’','-','‘','/'), '', $value);
        return $title;
    }
}

if (!function_exists('get_country_name')) {
    function get_country_name($kod_char_2)
    {
        $countries = [
            'UZ' => "Узбекистан"
        ];
        return $countries[$kod_char_2] ?? $kod_char_2;
    }
}

if (!function_exists('get_region_name')) {
    function get_region_name($kod)
    {
        $regions = get_region_list();
        return $regions[$kod] ?? $kod;
    }
}

if (!function_exists('get_region_area_name')) {
    function get_region_area_name($kod)
    {
        $region_area = get_region_area_list();
        return $region_area[$kod] ?? $kod;
    }
}

if (!function_exists('check_passport_image_path')) {
    function check_passport_image_path($image)
    {
        $simple = public_path('img/passport_images/'.$image);
        $online = public_path('img/rest_test_images/'.$image);
        if(File::exists($simple)){
            return asset("img/passport_images/".$image);
        }elseif(File::exists($online)){
            return asset("img/rest_test_images/".$image);
        }else{
            return asset("img/passport_images/no-image.jpg");
        }
    }
}

if (!function_exists('replace_keys_in_array')) {
    function replace_keys_in_array($oldKey, $newKey, array $input)
    {
        $return = array();
        foreach ($input as $key => $value) {
            if ($key === $oldKey)
                $key = $newKey;

            if (is_array($value))
                $value = replaceKeys($oldKey, $newKey, $value);

            $return[$key] = $value;
        }
        return $return;
    }
}

if(!function_exists('get_settings_value_by_name')){
    function get_settings_value_by_name($name = null){
        return App\Models\Setting::getValueSettingByName($name);
    }
}

if(!function_exists('get_settings_json_value_by_name')){
    function get_settings_json_value_by_name($name, $key){
        $setting = json_decode(get_settings_value_by_name($name), true);
        if (json_last_error() === JSON_ERROR_NONE)
            return $setting[$key];
    }
}

if(!function_exists('get_card_type')){
    function get_card_type($card_number){
        $card_pan = substr($card_number,0,4);
        switch ($card_pan) {
            case "9860":
                $type = 'HUMO';
                break;
            case "8600":
                $type = 'UZCARD';
                break;
            default:
                $type = null;
                break;
        }
        return $type;
    }
}

if(!function_exists('send_sms')){
    function send_sms($phone, $content){
        return (new App\Services\Unired\SendUniredSms)->apply($phone, $content);
    }
}

if(!function_exists('send_sms_otp')){
    function send_sms_otp($phone, $otp){
        $content = "Tasdiqlash kodi: {$otp}. Ushbu kodni hech kimga bermang!";
        return (new App\Services\Unired\SendUniredSms)->apply($phone, $content);
    }
}

if(!function_exists('get_pdf_info_by_ucard')){
    function get_pdf_info_by_ucard($card_number){
        return (new App\Services\IABS\Client)->getPdfInfoByCardNumber($card_number);
    }
}

if(!function_exists('get_no_image')){
    function get_no_image(){
        return 'data:image/png;base64,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';
    }
}

if (!function_exists('get_region_list')) {
    function get_region_list()
    {
        $regions = [
            '35' => 'КОРАКАЛПОГИСТОН РЕСПУБЛИКАСИ',
            '3' => 'АНДИЖОН ВИЛОЯТИ',
            '6' => 'БУХОРО ВИЛОЯТИ',
            '8' => 'ЖИЗЗАХ ВИЛОЯТИ',
            '10' => 'КАШКАДАРЁ ВИЛОЯТИ',
            '12' => 'НАВОИЙ ВИЛОЯТИ',
            '14' => 'НАМАНГАН ВИЛОЯТИ',
            '18' => 'САМАРКАНД ВИЛОЯТИ',
            '22' => 'СУРХОНДАРЁ ВИЛОЯТИ',
            '24' => 'СИРДАРЁ ВИЛОЯТИ',
            '26' => 'ТОШКЕНТ ШАХРИ',
            '27' => 'ТОШКЕНТ ВИЛОЯТИ',
            '30' => 'ФАРГОНА ВИЛОЯТИ',
            '33' => 'ХОРАЗМ ВИЛОЯТИ'
        ];
        asort($regions);
        return $regions;
    }
}

if (!function_exists('get_region_area_list')) {
    function get_region_area_list()
    {
        $areas = [
            '210' => 'УЛУГНОР ТУМАНИ',
            '214' => 'ШАХРИХОН ТУМАНИ',
            '5' => 'Г.ШАХРИХАН',
            '4' => 'КОРАСУВ ШАХРИ',
            '3' => 'ХОНОБОД ШАХРИ',
            '2' => 'АСАКА ШАХРИ',
            '1' => 'АНДИЖОН ШАХРИ',
            '18' => 'ХУЖАОБОД ТУМАНИ',
            '17' => 'ПАХТАОБОД ТУМАНИ',
            '16' => 'ОЛТИНКУЛ ТУМАНИ',
            '15' => 'МАРХАМАТ ТУМАНИ',
            '14' => 'КУРГОНТЕПА ТУМАНИ',
            '13' => 'КОМСОМОЛАБАДСКИЙ',
            '12' => 'ИЗБОСКАН ТУМАНИ',
            '11' => 'ЖАЛОЛКУДУК ТУМАНИ',
            '10' => 'БУЛОКБОШИ ТУМАНИ',
            '9' => 'БУЗ ТУМАНИ',
            '8' => 'БАЛИКЧИ ТУМАНИ',
            '7' => 'АСАКА ТУМАНИ',
            '6' => 'АНДИЖОН ТУМАНИ',
            '220' => 'КОГОН ШАХРИ',
            '30' => 'БУХОРО ШАХРИ',
            '29' => 'КОГОН ТУМАНИ',
            '28' => 'КОРОВУЛБОЗОР ТУМАНИ',
            '27' => 'ПЕШКУ ТУМАНИ',
            '26' => 'ШОФИРКОН ТУМАНИ',
            '25' => 'ЖОНДОР ТУМАНИ',
            '24' => 'РОМИТАН ТУМАНИ',
            '23' => 'КОРАКУЛ ТУМАНИ',
            '22' => 'БУХОРО ТУМАНИ',
            '21' => 'ГИЖДУВОН ТУМАНИ',
            '20' => 'ВОБКЕНТ ТУМАНИ',
            '19' => 'ОЛОТ ТУМАНИ',
            '217' => 'ЯНГИОБОД ТУМАНИ',
            '42' => 'ЗАРБДОР ТУМАНИ',
            '41' => 'АРНАСОЙ ТУМАНИ',
            '40' => 'ШАРОФ РАШИДОВ',
            '39' => 'ЗАФАРОБОД ТУМАНИ',
            '38' => 'ФОРИШ ТУМАНИ',
            '37' => 'БАХМАЛ ТУМАНИ',
            '36' => 'ЗОМИН ТУМАНИ',
            '35' => 'МИРЗАЧУЛ ТУМАНИ',
            '34' => 'ДУСТЛИК ТУМАНИ',
            '33' => 'ГАЛЛАОРОЛ ТУМАНИ',
            '32' => 'ПАХТАКОР ТУМАНИ',
            '31' => 'ЖИЗЗАХ ШАХРИ',
            '213' => 'ШАХРИСАБЗ ТУМАНИ',
            '221' => 'МИРИШКОР ТУМАНИ',
            '51' => 'ЯККАБОГ ТУМАНИ',
            '50' => 'ЧИРОКЧИ ТУМАНИ',
            '49' => 'ШАХРИСАБЗ ШАХРИ',
            '48' => 'КОСОН ТУМАНИ',
            '47' => 'КАМАШИ ТУМАНИ',
            '46' => 'ДЕХКОНОБОД ТУМАНИ',
            '45' => 'ГУЗОР ТУМАНИ',
            '44' => 'КАРШИ ТУМАНИ',
            '43' => 'КАРШИ ШАХРИ',
            '57' => 'БАХОРИСТАНСКИЙ',
            '56' => 'МУБОРАК ТУМАНИ',
            '55' => 'У.ЮСУПОВСКИЙ',
            '54' => 'НИШОН ТУМАНИ',
            '53' => 'КАСБИ ТУМАНИ',
            '52' => 'КИТОБ ТУМАНИ',
            '211' => 'УЧКУДУК ТУМАНИ',
            '67' => 'ТОМДИ ТУМАНИ',
            '66' => 'ХАТИРЧИ ТУМАНИ',
            '65' => 'НУРОТА ТУМАНИ',
            '64' => 'НАВБАХОР ТУМАНИ',
            '63' => 'КИЗИЛТЕПА ТУМАНИ',
            '62' => 'КОНИМЕХ ТУМАНИ',
            '61' => 'КАРМАНА ТУМАНИ',
            '60' => 'Г.УЧКУДУК',
            '59' => 'ЗАРАФШОН ШАХРИ',
            '58' => 'НАВОИЙ ШАХРИ',
            '77' => 'ЯНГИКУРГОН ТУМАНИ',
            '76' => 'ЧУСТ ТУМАНИ',
            '75' => 'УЧКУРГОН ТУМАНИ',
            '74' => 'УЙЧИ ТУМАНИ',
            '73' => 'ТУРАКУРГОН ТУМАНИ',
            '72' => 'ПОП ТУМАНИ',
            '71' => 'НОРИН ТУМАНИ',
            '70' => 'КОСОНСОЙ ТУМАНИ',
            '69' => 'МИНГБУЛОК ТУМАНИ',
            '68' => 'НАМАНГАН ШАХРИ',
            '79' => 'ЧОРТОК ТУМАНИ',
            '78' => 'НАМАНГАН ТУМАНИ',
            '218' => 'Г.АКТАШ',
            '219' => 'Г.УРГУТ',
            '215' => 'ТЕМИРЮЛЬСКИЙ',
            '97' => 'КАТТАКУРГОН ШАХРИ',
            '96' => 'САМАРКАНД ШАХРИ',
            '95' => 'ЧЕЛЕКСКИЙ',
            '94' => 'УРГУТ ТУМАНИ',
            '93' => 'ТАЙЛОК ТУМАНИ',
            '92' => 'САМАРКАНД ТУМАНИ',
            '91' => 'ПАЙАРИК ТУМАНИ',
            '90' => 'ПАХТАЧИ ТУМАНИ',
            '89' => 'ПАСТДАРГОМ ТУМАНИ',
            '88' => 'НУРОБОД ТУМАНИ',
            '87' => 'НАРПАЙ ТУМАНИ',
            '86' => 'КУШРАБОТ ТУМАНИ',
            '85' => 'КАТТАКУРГОН ТУМАНИ',
            '84' => 'ИШТИХОН ТУМАНИ',
            '83' => 'ЖОМБОЙ ТУМАНИ',
            '82' => 'ГУЗАЛКЕНТСКИЙ',
            '81' => 'БУЛУНГУР ТУМАНИ',
            '80' => 'ОКДАРЁ ТУМАНИ',
            '112' => 'БАНДИХОН ТУМАНИ',
            '111' => 'ОЛТИНСОЙ ТУМАНИ',
            '110' => 'ТЕРМИЗ ТУМАНИ',
            '101' => 'ЖАРКУРГОН ТУМАНИ',
            '100' => 'ДЕНОВ ТУМАНИ',
            '109' => 'КУМКУРГОН ТУМАНИ',
            '108' => 'КИЗИРИК ТУМАНИ',
            '107' => 'АНГОР ТУМАНИ',
            '106' => 'САРИОСИЁ ТУМАНИ',
            '105' => 'УЗУН ТУМАНИ',
            '104' => 'ШУРЧИ ТУМАНИ',
            '103' => 'ШЕРОБОД ТУМАНИ',
            '102' => 'МУЗРАБОТ ТУМАНИ',
            '99' => 'БОЙСУН ТУМАНИ',
            '98' => 'ТЕРМИЗ ШАХРИ',
            '116' => 'ШИРИН ШАХРИ',
            '115' => 'ЯНГИЕР ШАХРИ',
            '114' => 'ГУЛИСТОН ШАХРИ',
            '113' => 'Г.БАХТ',
            '126' => 'МИРЗАОБОД ТУМАНИ',
            '125' => 'МЕХНАТАБАДСКИЙ',
            '124' => 'ХАВАСТ ТУМАНИ',
            '123' => 'САЙХУНОБОД ТУМАНИ',
            '122' => 'СИРДАРЁ ТУМАНИ',
            '121' => 'САРДОБА ТУМАНИ',
            '120' => 'ГУЛИСТОН ТУМАНИ',
            '119' => 'БОЁВУТ ТУМАНИ',
            '118' => 'ОКОЛТИН ТУМАНИ',
            '117' => 'Г.СЫРДАРЬЯ',
            '207' => 'ЯШНОБОД ТУМАНИ',
            '205' => 'СИРГАЛИ ТУМАНИ',
            '203' => 'ШАЙХОНТОХУР ТУМАНИ',
            '201' => 'МИРЗО УЛУГБЕК',
            '200' => 'ЮНУСОБОД ТУМАНИ',
            '197' => 'ТОШКЕНТ ШАХРИ',
            '199' => 'БЕКТЕМИР ТУМАНИ',
            '198' => 'УЧТЕПА ТУМАНИ',
            '202' => 'МИРОБОД ТУМАНИ',
            '204' => 'ОЛМАЗОР ТУМАНИ',
            '206' => 'ЯККАСАРОЙ ТУМАНИ',
            '208' => 'ЧИЛОНЗОР ТУМАНИ',
            '223' => 'НУРАФШОН ШАХРИ',
            '147' => 'ЯНГИЙУЛ ШАХРИ',
            '146' => 'ЯНГИЙУЛ ТУМАНИ',
            '145' => 'ЮКОРИЧИРЧИК ТУМАНИ',
            '144' => 'ЧИНОЗ ТУМАНИ',
            '143' => 'УРТАЧИРЧИК ТУМАНИ',
            '142' => 'ТОШКЕНТ ТУМАНИ',
            '133' => 'ОХАНГАРОН ТУМАНИ',
            '132' => 'ОККУРГОН ТУМАНИ',
            '131' => 'ЧИРЧИК ШАХРИ',
            '130' => 'БЕКОБОД ШАХРИ',
            '129' => 'АНГРЕН ШАХРИ',
            '128' => 'ОЛМАЛИК ШАХРИ',
            '127' => 'ОХАНГАРОН ШАХРИ',
            '141' => 'ПСКЕНТ ТУМАНИ',
            '140' => 'КУЙИЧИРЧИК ТУМАНИ',
            '139' => 'ПАРКЕНТ ТУМАНИ',
            '138' => 'КИБРАЙ ТУМАНИ',
            '137' => 'БЕКОБОД ТУМАНИ',
            '136' => 'ЗАНГИОТА ТУМАНИ',
            '135' => 'БУКА ТУМАНИ',
            '134' => 'БУСТОНЛИК ТУМАНИ',
            '165' => 'ФАРГОНА ТУМАНИ',
            '164' => 'УЧКУПРИК ТУМАНИ',
            '163' => 'УЗБЕКИСТОН ТУМАНИ',
            '162' => 'ТОШЛОК ТУМАНИ',
            '161' => 'СУХ ТУМАНИ',
            '160' => 'РИШТОН ТУМАНИ',
            '159' => 'КУШТЕПА ТУМАНИ',
            '158' => 'ОЛТИАРИК ТУМАНИ',
            '157' => 'КУВА ТУМАНИ',
            '156' => 'ЁЗЁВОН ТУМАНИ',
            '155' => 'ДАНГАРА ТУМАНИ',
            '154' => 'БУВАЙДА ТУМАНИ',
            '153' => 'БОГДОД ТУМАНИ',
            '152' => 'БЕШАРИК ТУМАНИ',
            '151' => 'КУВАСОЙ ШАХРИ',
            '150' => 'ФАРГОНА ШАХРИ',
            '149' => 'МАРГИЛОН ШАХРИ',
            '148' => 'КУКОН ШАХРИ',
            '167' => 'КИРГУЛИЙСКИЙ',
            '166' => 'ФУРКАТ ТУМАНИ',
            '173' => 'ХАЗОРАСП ТУМАНИ',
            '172' => 'БОГОТ ТУМАНИ',
            '212' => 'ХИВА ТУМАНИ',
            '179' => 'ЯНГИБОЗОР ТУМАНИ',
            '178' => 'УРГАНЧ ТУМАНИ',
            '177' => 'ШОВОТ ТУМАНИ',
            '176' => 'КУШКУПИР ТУМАНИ',
            '175' => 'ЯНГИАРИК ТУМАНИ',
            '174' => 'ХОНКА ТУМАНИ',
            '171' => 'ГУРЛАН ТУМАНИ',
            '170' => 'ПИТНАК ШАХРИ',
            '169' => 'ХИВА ШАХРИ',
            '168' => 'УРГАНЧ ШАХРИ',
            '222' => 'ТАХИАТОШ ТУМАНИ',
            '195' => 'БОЗАТАУССКИЙ',
            '194' => 'ЭЛЛИККАЛА ТУМАНИ',
            '193' => 'КОРАУЗАК ТУМАНИ',
            '192' => 'КОНЛИКУЛ ТУМАНИ',
            '191' => 'БЕРУНИЙ ТУМАНИ',
            '190' => 'ЧИМБОЙ ТУМАНИ',
            '196' => 'МАНГИТСКИЙ',
            '209' => 'АМУДАРЁ ТУМАНИ',
            '216' => 'НУКУС ТУМАНИ',
            '181' => 'ТАХИАТОШ ШАХРИ',
            '180' => 'НУКУС ШАХРИ',
            '189' => 'ХУЖАЙЛИ ТУМАНИ',
            '188' => 'ТУРТКУЛ ТУМАНИ',
            '187' => 'ТАХТАКУПИР ТУМАНИ',
            '186' => 'АКМАНГИТСКИЙ',
            '185' => 'МУЙНОК ТУМАНИ',
            '184' => 'КУНГИРОТ ТУМАНИ',
            '183' => 'ШУМАНАЙ ТУМАНИ',
            '182' => 'КЕГЕЙЛИ ТУМАНИ',
        ];
        asort($areas);
        return $areas;
    }

    // Json Error Response
    if(!function_exists('json_error_response')){
        function json_error_response($method, $code = "-999", $message = "Сервер не работает"){
            return [
                "jsonrpc" => "2.0",
                "id"      => "1",
                "status"  => false,
                "origin"  => str_replace('_', '.', $method),
                "error"   => [
                    "code"    => $code,
                    "message" => [
                        "ru"  => $message,
                        "uz"  => $message,
                        "en"  => $message,
                    ]
                ]
            ];
        }
    }
}

