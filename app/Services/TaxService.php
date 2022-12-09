<?php
namespace App\Services;

class TaxService
{
//    private $tax_base_url    = "https://api.i-hamkor.uz";
    private $tax_base_url    = "https://unired.uz/app/index";

    private $tax_base_       = "https://unired.uz/app/index";

    private $tax_scoring_url = "https://unired.uz/tax/scoring";

    // Информация по физическим лицам:
    private $person_info_url = 'https://api.i-hamkor.uz/gnk/data/fiznp1';
    // Информация по юридическим лицам:
    private $legal_info_url  = 'https://api.i-hamkor.uz/gnk/data/yurnp1';

    private $tax_common_url = 'https://api.i-hamkor.uz/gnk/commons';
    // Справочники:
    private $common_url_lists = [
        // Справочник СООГУ:
        'nc1',
        // Справочник кодов областей:
        'ns10',
        // Справочник кодов районов:
        'ns11',
        // Справочник наименований Статуса:
        'na1',
        // Справочник наименований Форм собственности:
        'ns4',
        // Справочник наименований Видов деятельности:
        'ns1',
        // Справочник наименований налогов - юр:
        'yurna2',
        // Справочник наименований налогов - физ:
        'fizna2'
    ];



    private $info_body       = [
        "tin"             => null,
        "pinfl"           => null,
        "series_passport" => null,
        "number_passport" => null,
        "lang"            => 'uz'
    ];

    public function getPersonalInfo($data)
    {
        if(array_key_exists('inn', $data)){
            $this->info_body['tin'] = $data['inn'];
        }
        if(array_key_exists('pin', $data)){
            $this->info_body['pinfl'] = $data['pin'];
        }
        if(array_key_exists('serial_number', $data)){
            $this->info_body['series_passport'] = extract_passport_seria($data['serial_number']);
            $this->info_body['number_passport'] = extract_passport_number($data['serial_number']);
        }

        $requestData = [
            "id" => "1",
            "jsonrpc"  => "2.0",
            "method"   => "payed.request",
            "params"   => [
                "url"  => $this->person_info_url,
                "body" => $this->info_body
            ]
        ];

        $ch = curl_init($this->tax_base_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: test'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $item = json_decode($server_output, true);
        if($item && array_key_exists('data', $item)) return $item;
    }

    public function getLegalInfo($data)
    {
        if(array_key_exists('inn', $data)){
            $this->info_body['tin'] = $data['inn'];
        }

        $requestData = [
            "id" => "1",
            "jsonrpc"  => "2.0",
            "method"   => "payed.request",
            "params"   => [
                "url"  => $this->legal_info_url,
                "body" => $this->info_body
            ]
        ];
        $ch = curl_init($this->tax_base_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: test'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $item = json_decode($server_output, true);
        if($item && array_key_exists('data', $item)) return $item;
    }

    public function getReference($segment){
        dd($this->common_url_lists);
        dd(array_key_exists($segment, $this->common_url_lists));
        $requestData = [
            "method" =>"payed.request_get",
            "params" => [
                "url" => $this->tax_common_url.'/'.$segment
            ]
        ];
        $ch = curl_init($this->tax_base_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: test'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $item = json_decode($server_output, true);
        if($item && array_key_exists('data', $item)) return $item;
    }

    public function getTaxScoring($inn, $passport = false, $pin = false)
    {
        $requestData = [
            "tin"      => $inn,
            "passport" => $passport ?? '',
            "pinfl"    => $pin ?? '',
            'type'     => true
        ];

        $ch = curl_init($this->tax_scoring_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: SKgG3BC4uyeJgeMJ',
            'Content-Type: application/json'));
        $server_output = curl_exec($ch);
        curl_close($ch);
        return json_decode($server_output, true);
    }

    public function getSalaryInfo($data){
        $requestData = [
            "method" =>"tax.get_salary",
            "params" => [
                "tin"      => $data['inn'] ?? "",
                "pinfl"    => $data['pin'] ?? "",
                "passport" => $data['serial_number'] ?? ""
            ]
        ];
        dd($requestData);
        $ch = curl_init($this->tax_base_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: test'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return json_decode($server_output, true);
    }
}