<?php
namespace App\Services;

use App\Http\Traits\CurlRequest;
use App\Traits\Logger;
use App\Models\Token;
use Carbon\Carbon;

class MyIdService
{
    use CurlRequest, Logger;
    private $base_url;
    private $token;
    private $settings;

    public function __construct()
    {
        $this->settings = json_decode(get_settings_value_by_name('myid'), true);
        $this->base_url = $this->settings['url'];
        $this->token    = $this->activeToken();
    }

    public function activeToken(){
        $token = Token::getToken('myid');
        if(!empty($token)){
            $endDate = Carbon::parse($token->token_expires_at);
            if($endDate->greaterThanOrEqualTo(Carbon::now())){
                return $token->access_token;
            }
        }
        $data = $this->getAccessToken();
        if($data && is_array($data) && array_key_exists('access_token', $data)){
            Token::createNew('myid', $data);
            return $data['access_token'];
        }
    }

    public function getAccessToken(){
        $headers = [
            'Content-Type: application/x-www-form-urlencoded'
        ];
        $params  = [
            'grant_type' => $this->settings['grant_type'],
            'username'   => $this->settings['username'],
            'password'   => $this->settings['password'],
            'client_id'  => $this->settings['client_id']
        ];
        $responseData = $this->post(
            $this->base_url.'/api/v1/oauth2/access-token',
            http_build_query($params),
            $headers,
            true
        );
        return $responseData;
    }

    public function getJobId($passData, $birthDate, $personPhoto){
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->token
        ];
        $params  = json_encode([
            'pass_data'         => $passData,
            'birth_date'        => Carbon::parse($birthDate)->format('Y-m-d'),
            'agreed_on_terms'   => true,
            'client_id'         => $this->settings['client_id'],
            'photo_from_camera' => [
                'front'         => $personPhoto
            ]
        ]);
        $responseData = $this->post(
            $this->base_url.'/api/v1/authentication/simple-inplace-authentication-request-task',
            $params,
            $headers
        );
//        if(!is_null($responseData)) $this->logger($responseData,'myid');
        return $responseData;
    }

    public function getPassportInfo($job_id){
        $headers = [
            'Authorization: Bearer '.$this->token
        ];
        $responseData = $this->post(
            $this->base_url.'/api/v1/authentication/simple-inplace-authentication-request-status?job_id='.$job_id,
            [],
            $headers
        );
        if(!is_null($responseData) || !empty($responseData)) $this->logger($responseData,'myid');
        return $responseData;
    }
}