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
if (!function_exists('get_message')) {
    function get_message($code,$value = []){
        return [
            'uz' => trans("codes.{$code}", $value, 'uz'),
            'ru' => trans("codes.{$code}", $value, 'ru'),
            'en' => trans("codes.{$code}", $value, 'en')
        ];
    }
}


if (!function_exists('get_code_message')) {
    function get_code_message($code)
    {
        $codes = [
            '10000' => [
                'uz' => 'Bunday ariza mavjud.',
                'ru' => '???????????? ?????? ????????.',
                'en' => 'Such an application is available.'
            ],
            '10001' => [
                'uz' => 'Arizangiz avval rad qilingan.',
                'ru' => '???????? ???????????? ?????????? ???????? ??????????????????.',
                'en' => 'Your application was previously rejected.'
            ],
            '10002' => [
                'uz' => 'Arizangiz blocklangan.',
                'ru' => '???????? ???????????????????? ??????????????????????????.',
                'en' => 'Your application has been blocked.'
            ],
            '10003' => [
                'uz' => 'Tug\'ilgan sana shartlarga mos kelmadi.',
                'ru' => '???????? ???????????????? ???? ?????????????????????????? ????????????????.',
                'en' => 'Date of birth did not match the conditions.'
            ],
            '10004' => [
                'uz' => 'Arizangiz rad qilindi.',
                'ru' => '???????? ???????????? ??????????????????.',
                'en' => 'Your application has been rejected.'
            ],
            '10005' => [
                'uz' => 'Bunday ariza UNIREDda mavjud.',
                'ru' => '???????????? ?????? ???????? ???? UNIRED.',
                'en' => 'Such an application is available at UNIRED.'
            ],
            '10006' => [
                'uz' => 'Bunday ariza mavjud emas.',
                'ru' => '???????????? ???? ????????????????????.',
                'en' => 'Application not found'
            ],
            '10100' => [
                'uz' => 'Arizangiz identifikatiya qilindi.',
                'ru' => '???????? ???????????? ???????? ????????????????????????????????.',
                'en' => 'Your application has been identified.'
            ],
            '10101' => [
                'uz' => 'Passport ma\'lumot to\'liq emas.',
                'ru' => '???????????????????? ???????????? ????????????????.',
                'en' => 'Passport information is incomplete.'
            ],
            '10102' => [
                'uz' => 'Arizangiz identifikatiya qilingan.',
                'ru' => '???????? ???????????? ???????? ????????????????????????????????.',
                'en' => 'Your application has been identified already.'
            ],
            '11111' => [
                'uz' => 'Serverda xatolik bor boshqatdan urunib ko\'ring!',
                'ru' => '???? ?????????????? ?????????????????? ????????????, ???????????????????? ?????? ??????!',
                'en' => 'An error occurred on the server, please try again!'
            ],
            '30109' => [
                'uz' => 'Oylik maosh ma\'lumoti topilmadi.',
                'ru' => '???????????????????? ?? ???????????????? ???????????????? ???? ??????????????.',
                'en' => 'Monthly salary information not found.'
            ],
            '30110' => [  // sariq
                'uz' => 'Ariza ko\'rib chiqishga tavfsiya etildi!',
                'ru' => '???????????? ???????? ?????????????????????????? ?? ????????????????????????!',
                'en' => 'Application recommended for consideration!'
            ],
            '30111' => [ // qizil
                'uz' => 'Ariza kredit tarixi sababli rad etildi!',
                'ru' => '???????????? ?????????????????? ????-???? ?????????????????? ??????????????!',
                'en' => 'Application rejected due to credit history!'
            ],
            '30112' => [ // yashil
                'uz' => 'Ariza muvaffaqiyatli tasdiqlandi.',
                'ru' => '???????????? ???????????????? ??????????????.',
                'en' => 'Application approved successfully.'
            ],
            '30113' => [
                'uz' => 'Ariza oylik maoshi kamligi sababli rad etildi.',
                'ru' => '???????????? ?????????????????? ????-???? ???????????? ???????????????? ???????????????????? ??????????.',
                'en' => 'Application rejected due to low monthly salary.'
            ],
            '40100'  => [
                'uz' => 'Ariza qabul qilindi.',
                'ru' => '???????????? ??????????????.',
                'en' => 'Application accepted.'
            ],
            '40102'  => [
                'uz' => 'Ariza rad etildi.',
                'ru' => '???????????? ????????????????.',
                'en' => 'Application canceled.'
            ],
        ];

        return $codes[$code];
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
            '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??',
            '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??',
            '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??',
            '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??', '??'
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
        $title = str_replace(array('\'', '"', ',', ';', '.', '???','-','???','/','"""'), ' ', $value);
        return $title;
    }
}

if (!function_exists('removeMarks')) {
    function removeMarks($value)
    {
        $title = str_replace(array('\'', '???','???','`','?','\'', '"', ',', ';', '.', '???','-','???','/'), '', $value);
        return $title;
    }
}

if (!function_exists('get_country_name')) {
    function get_country_name($kod_char_2)
    {
        $countries = [
            'UZ' => "????????????????????"
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

if(!function_exists('get_tax_periods')){
    function get_tax_periods($filter, $period = 7){
        $periods   = now()->subMonths($period)->monthsUntil(now());
        $data     = [];
        foreach ($periods as $date)
        {
            $data[] = [
                'month' => $date->month,
                'year'  => $date->year,
            ];
        }
        if($filter == 'year') return array_unique(array_column($data,'year'));
        if($filter == 'month') return array_unique(array_column($data,'month'));
        return $data;
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
            '35' => '?????????????????????????????? ????????????????????????',
            '3' => '?????????????? ??????????????',
            '6' => '???????????? ??????????????',
            '8' => '???????????? ??????????????',
            '10' => '?????????????????? ??????????????',
            '12' => '???????????? ??????????????',
            '14' => '???????????????? ??????????????',
            '18' => '?????????????????? ??????????????',
            '22' => '???????????????????? ??????????????',
            '24' => '?????????????? ??????????????',
            '26' => '?????????????? ??????????',
            '27' => '?????????????? ??????????????',
            '30' => '?????????????? ??????????????',
            '33' => '???????????? ??????????????'
        ];
        asort($regions);
        return $regions;
    }
}

if (!function_exists('get_region_area_list')) {
    function get_region_area_list()
    {
        $areas = [
            '210' => '?????????????? ????????????',
            '214' => '???????????????? ????????????',
            '5' => '??.????????????????',
            '4' => '?????????????? ??????????',
            '3' => '?????????????? ??????????',
            '2' => '?????????? ??????????',
            '1' => '?????????????? ??????????',
            '18' => '???????????????? ????????????',
            '17' => '?????????????????? ????????????',
            '16' => '???????????????? ????????????',
            '15' => '???????????????? ????????????',
            '14' => '???????????????????? ????????????',
            '13' => '????????????????????????????????',
            '12' => '???????????????? ????????????',
            '11' => '???????????????????? ????????????',
            '10' => '?????????????????? ????????????',
            '9' => '?????? ????????????',
            '8' => '?????????????? ????????????',
            '7' => '?????????? ????????????',
            '6' => '?????????????? ????????????',
            '220' => '?????????? ??????????',
            '30' => '???????????? ??????????',
            '29' => '?????????? ????????????',
            '28' => '???????????????????????? ????????????',
            '27' => '?????????? ????????????',
            '26' => '???????????????? ????????????',
            '25' => '???????????? ????????????',
            '24' => '?????????????? ????????????',
            '23' => '?????????????? ????????????',
            '22' => '???????????? ????????????',
            '21' => '???????????????? ????????????',
            '20' => '?????????????? ????????????',
            '19' => '???????? ????????????',
            '217' => '???????????????? ????????????',
            '42' => '?????????????? ????????????',
            '41' => '?????????????? ????????????',
            '40' => '?????????? ??????????????',
            '39' => '?????????????????? ????????????',
            '38' => '?????????? ????????????',
            '37' => '???????????? ????????????',
            '36' => '?????????? ????????????',
            '35' => '???????????????? ????????????',
            '34' => '?????????????? ????????????',
            '33' => '?????????????????? ????????????',
            '32' => '???????????????? ????????????',
            '31' => '???????????? ??????????',
            '213' => '?????????????????? ????????????',
            '221' => '???????????????? ????????????',
            '51' => '?????????????? ????????????',
            '50' => '?????????????? ????????????',
            '49' => '?????????????????? ??????????',
            '48' => '?????????? ????????????',
            '47' => '???????????? ????????????',
            '46' => '???????????????????? ????????????',
            '45' => '?????????? ????????????',
            '44' => '?????????? ????????????',
            '43' => '?????????? ??????????',
            '57' => '????????????????????????????',
            '56' => '?????????????? ????????????',
            '55' => '??.????????????????????',
            '54' => '?????????? ????????????',
            '53' => '?????????? ????????????',
            '52' => '?????????? ????????????',
            '211' => '?????????????? ????????????',
            '67' => '?????????? ????????????',
            '66' => '?????????????? ????????????',
            '65' => '???????????? ????????????',
            '64' => '???????????????? ????????????',
            '63' => '?????????????????? ????????????',
            '62' => '?????????????? ????????????',
            '61' => '?????????????? ????????????',
            '60' => '??.??????????????',
            '59' => '???????????????? ??????????',
            '58' => '???????????? ??????????',
            '77' => '???????????????????? ????????????',
            '76' => '???????? ????????????',
            '75' => '???????????????? ????????????',
            '74' => '???????? ????????????',
            '73' => '???????????????????? ????????????',
            '72' => '?????? ????????????',
            '71' => '?????????? ????????????',
            '70' => '???????????????? ????????????',
            '69' => '?????????????????? ????????????',
            '68' => '???????????????? ??????????',
            '79' => '???????????? ????????????',
            '78' => '???????????????? ????????????',
            '218' => '??.??????????',
            '219' => '??.??????????',
            '215' => '????????????????????????',
            '97' => '?????????????????????? ??????????',
            '96' => '?????????????????? ??????????',
            '95' => '??????????????????',
            '94' => '?????????? ????????????',
            '93' => '???????????? ????????????',
            '92' => '?????????????????? ????????????',
            '91' => '?????????????? ????????????',
            '90' => '?????????????? ????????????',
            '89' => '???????????????????? ????????????',
            '88' => '?????????????? ????????????',
            '87' => '???????????? ????????????',
            '86' => '???????????????? ????????????',
            '85' => '?????????????????????? ????????????',
            '84' => '?????????????? ????????????',
            '83' => '???????????? ????????????',
            '82' => '??????????????????????????',
            '81' => '???????????????? ????????????',
            '80' => '???????????? ????????????',
            '112' => '???????????????? ????????????',
            '111' => '???????????????? ????????????',
            '110' => '???????????? ????????????',
            '101' => '?????????????????? ????????????',
            '100' => '?????????? ????????????',
            '109' => '?????????????????? ????????????',
            '108' => '?????????????? ????????????',
            '107' => '?????????? ????????????',
            '106' => '???????????????? ????????????',
            '105' => '???????? ????????????',
            '104' => '?????????? ????????????',
            '103' => '?????????????? ????????????',
            '102' => '???????????????? ????????????',
            '99' => '???????????? ????????????',
            '98' => '???????????? ??????????',
            '116' => '?????????? ??????????',
            '115' => '???????????? ??????????',
            '114' => '???????????????? ??????????',
            '113' => '??.????????',
            '126' => '?????????????????? ????????????',
            '125' => '????????????????????????????',
            '124' => '???????????? ????????????',
            '123' => '???????????????????? ????????????',
            '122' => '?????????????? ????????????',
            '121' => '?????????????? ????????????',
            '120' => '???????????????? ????????????',
            '119' => '???????????? ????????????',
            '118' => '?????????????? ????????????',
            '117' => '??.????????????????',
            '207' => '?????????????? ????????????',
            '205' => '?????????????? ????????????',
            '203' => '?????????????????????? ????????????',
            '201' => '?????????? ??????????????',
            '200' => '???????????????? ????????????',
            '197' => '?????????????? ??????????',
            '199' => '???????????????? ????????????',
            '198' => '???????????? ????????????',
            '202' => '?????????????? ????????????',
            '204' => '?????????????? ????????????',
            '206' => '?????????????????? ????????????',
            '208' => '???????????????? ????????????',
            '223' => '???????????????? ??????????',
            '147' => '?????????????? ??????????',
            '146' => '?????????????? ????????????',
            '145' => '?????????????????????? ????????????',
            '144' => '?????????? ????????????',
            '143' => '???????????????????? ????????????',
            '142' => '?????????????? ????????????',
            '133' => '?????????????????? ????????????',
            '132' => '???????????????? ????????????',
            '131' => '???????????? ??????????',
            '130' => '?????????????? ??????????',
            '129' => '???????????? ??????????',
            '128' => '?????????????? ??????????',
            '127' => '?????????????????? ??????????',
            '141' => '???????????? ????????????',
            '140' => '???????????????????? ????????????',
            '139' => '?????????????? ????????????',
            '138' => '???????????? ????????????',
            '137' => '?????????????? ????????????',
            '136' => '???????????????? ????????????',
            '135' => '???????? ????????????',
            '134' => '?????????????????? ????????????',
            '165' => '?????????????? ????????????',
            '164' => '???????????????? ????????????',
            '163' => '???????????????????? ????????????',
            '162' => '???????????? ????????????',
            '161' => '?????? ????????????',
            '160' => '???????????? ????????????',
            '159' => '?????????????? ????????????',
            '158' => '???????????????? ????????????',
            '157' => '???????? ????????????',
            '156' => '???????????? ????????????',
            '155' => '?????????????? ????????????',
            '154' => '?????????????? ????????????',
            '153' => '???????????? ????????????',
            '152' => '?????????????? ????????????',
            '151' => '?????????????? ??????????',
            '150' => '?????????????? ??????????',
            '149' => '???????????????? ??????????',
            '148' => '?????????? ??????????',
            '167' => '????????????????????????',
            '166' => '???????????? ????????????',
            '173' => '???????????????? ????????????',
            '172' => '?????????? ????????????',
            '212' => '???????? ????????????',
            '179' => '?????????????????? ????????????',
            '178' => '???????????? ????????????',
            '177' => '?????????? ????????????',
            '176' => '???????????????? ????????????',
            '175' => '???????????????? ????????????',
            '174' => '?????????? ????????????',
            '171' => '???????????? ????????????',
            '170' => '???????????? ??????????',
            '169' => '???????? ??????????',
            '168' => '???????????? ??????????',
            '222' => '???????????????? ????????????',
            '195' => '????????????????????????',
            '194' => '?????????????????? ????????????',
            '193' => '???????????????? ????????????',
            '192' => '???????????????? ????????????',
            '191' => '?????????????? ????????????',
            '190' => '???????????? ????????????',
            '196' => '????????????????????',
            '209' => '?????????????? ????????????',
            '216' => '?????????? ????????????',
            '181' => '???????????????? ??????????',
            '180' => '?????????? ??????????',
            '189' => '?????????????? ????????????',
            '188' => '?????????????? ????????????',
            '187' => '???????????????????? ????????????',
            '186' => '????????????????????????',
            '185' => '???????????? ????????????',
            '184' => '???????????????? ????????????',
            '183' => '?????????????? ????????????',
            '182' => '?????????????? ????????????',
        ];
        asort($areas);
        return $areas;
    }

    // Json Error Response
    if(!function_exists('json_error_response')){
        function json_error_response($method, $code = "-999", $message = "???????????? ???? ????????????????"){
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

