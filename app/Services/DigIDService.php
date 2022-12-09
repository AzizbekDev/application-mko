<?php
namespace App\Services;

use Log;
use App\Models\PersonalInfoReport;

class DigIdService
{
    private $base_url;
    private $new_base_url;
    private $grant_type;
    private $basic_auth;
    private $login;
    private $password;

    public function __construct(){
        $this->base_url     = "https://api.digid.uz:31415";
        $this->new_base_url = "https://api.digid.uz:8080/digid-service/passport/ru/passportInfo";
        // $this->password  = "uni334852g";
        $this->login        = get_settings_json_value_by_name('digid_credentials','login');;
        $this->password     = get_settings_json_value_by_name('digid_credentials','password');
        $this->base_auth    = base64_encode($this->login.":".$this->password);
        $this->grant_type   = "password";
    }

    public function getPassportInfo($dataRequest){
        dd($this->base_auth);
        set_time_limit(35);
        $data = array(
            "RequestGuid"            => $this->generateGUID(),
            "ModelPersonPassport"    => array(
                'PersonPassport'     => array(
                    'DocumentNumber' => mb_strtoupper($dataRequest['serial_number']),
                    'Pinpp'          => $dataRequest['pin'],
                    'birthDate'      => extract_passport_birth_date($dataRequest['pin']),
                    "DocumentType"   => "P"
                ),
            ),
        );
        $json = json_encode($data);
        $ch = curl_init($this->new_base_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER,[
            'Content-Type: application/json',
            "Authorization: Basic {$this->base_auth}"
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,30);
        curl_setopt($ch,CURLOPT_TIMEOUT,28);
        $server_output = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        dd($err);
        if($server_output){
            $item = json_decode($server_output, true);
            $this->logNewResponse($data, $item);
            if(!json_last_error()) return $item;
        }
        PersonalInfoReport::create([
            'partner_id'       => request()->partner_id,
            'status'           => '2',
            'request_body'     => $json
        ]);
        return array('error' => true, 'message', $err ?? 'Server not working!');
    }

    protected function generateGUID(){
        if(function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);
            $chard = md5(uniqid(rand(), true));
            $hyphen = chr(45); // "-"
            return substr($chard,0,8).$hyphen
                .substr($chard,8,4).$hyphen
                .substr($chard,12,4).$hyphen
                .substr($chard,16,4).$hyphen
                .substr($chard,20,12);
        }
    }
    protected function logNewResponse($data, $item){
        if((isset($item['code']) && $item['code'] == false) && !isset($item['error'])){
            $log_array = array_merge($item['response'],$data);
            Log::channel('digidlogger')->info(json_encode($log_array,JSON_UNESCAPED_UNICODE ));
            PersonalInfoReport::create([
                'partner_id'       => request()->partner_id,
                'status'           => '0',
                'request_body'     => json_encode($data),
                'response_code'    => $item['code'],
                'response_message' => $item['message']
            ]);
        }else{
            $log_array = array_merge($item,$data);
            Log::channel('digidlogger')->error(json_encode($log_array,JSON_UNESCAPED_UNICODE ));
            PersonalInfoReport::create([
                'partner_id'       => request()->partner_id,
                'status'           => '1',
                'request_body'     => json_encode($data),
                'response_code'    => $item['code'],
                'response_message' => $item['message']
            ]);
        }
    }
}