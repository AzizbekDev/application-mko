<?php
namespace App\Services\Unired;

use Log;
use App\Http\Traits\CurlRequest;
use App\Models\Settings;

class SendUniredSms
{
    use CurlRequest;
    private $base_url = "https://sms.unired.uz/api/sms";
    private $username = "Unired";
    private $password = "password";

    public function apply($phone,$content)
    {
        $access_token = get_settings_value_by_name('sms_access_token_unired');
        $sms_body     = [
            "method" =>  "send",
            "params" => [
                (object)[
                    "phone"   => $phone,
                    "content" => $content
                ]
            ]
        ];
        $headers = [
            'Authorization: Bearer '.$access_token,
            'Content-Type:application/json',
            'Accept:application/json'
        ];
        $response = $this->post($this->base_url,json_encode($sms_body),$headers);

        return $this->logSms($response);
    }

    protected function logSms($response){
        if($response && array_key_exists('status', $response) && $response['status']){
            Log::channel('smslogger')->info(json_encode($response,JSON_UNESCAPED_UNICODE ));
        }else{
            Log::channel('smslogger')->error(json_encode($response,JSON_UNESCAPED_UNICODE ));
        }
        return $response;
    }
}