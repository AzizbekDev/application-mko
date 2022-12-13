<?php
namespace App\Services;

use App\Http\Traits\CurlRequest;
use App\Models\Token;

class MyIdService
{
    use CurlRequest;
    private $base_url;
    private $token;
    private $settings;

    public function __construct()
    {
        $this->settings = json_decode(get_settings_value_by_name('myid'), true);
        $this->base_url = $this->settings['url'];
        $this->token    = Token::getToken('myid');
        dd($this->token);
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
        $response = $this->post(
            $this->base_url.'/api/v1/oauth2/access-token',
            http_build_query($params),
            $headers,
            true
        );
        return $response;
    }

    public function getJobId($passData, $birthDate, $personPhoto){
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->token
        ];
        $params  = json_encode([
            'pass_data'         => $passData,
            'birth_date'        => $birthDate,
            'agreed_on_terms'   => true,
            'client_id'         => $this->settings['client_id'],
            'photo_from_camera' => [
                'front'         => $personPhoto
            ]
        ]);
        $response = $this->post(
            $this->base_url.'/api/v1/authentication/simple-inplace-authentication-request-task',
            $params,
            $headers
        );
        return $response;
    }

    public function getPassportInfo($job_id){
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->token
        ];

        $params = [
          'job_id' => $job_id
        ];

        $response = $this->post(
            $this->base_url.'/api/v1/authentication/simple-inplace-authentication-request-status',
            http_build_query($params),
            $headers
        );
        return $response;
    }
}