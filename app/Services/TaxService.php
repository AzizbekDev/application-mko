<?php
namespace App\Services;

use App\Http\Traits\CurlRequest;
use App\Traits\Logger;

class TaxService
{
    use CurlRequest, Logger;
    private $base_url;
    private $token;
    private $headers;
    private $settings;
    private $info_body    = [
        "tin"             => null,
        "pinfl"           => null,
        "series_passport" => null,
        "number_passport" => null,
        "lang"            => 'uz'
    ];

    public function __construct()
    {
        $this->settings = json_decode(get_settings_value_by_name('tax'), true);
        $this->base_url = $this->settings['url'];
        $this->token    = base64_encode($this->settings['username'].':'.$this->settings['password']);
        $this->headers  = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic '.$this->token
        ];
    }

    public function getSalaryInfo($data){
        $this->getParams($data);
        $responseData = $this->post($this->base_url.'/fiz-salary', json_encode($this->info_body),$this->headers);
//      $responseData = json_decode(\App\Models\Logger::find(1)->response, true);
        if(!is_null($responseData) || !empty($responseData)) $this->logger($responseData,'tax');
        return $responseData;
    }

    protected function getParams($data){
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
    }
}