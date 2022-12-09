<?php
namespace App\Http\Traits;

trait CurlRequest{

    public function post($url, $params = [], $headers = [], $return_curl_info = false)
    {
        ini_set('memory_limit', '-1');
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 24);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 4);

        curl_setopt($curl, CURLOPT_POST,1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result        = curl_exec($curl);
        $code          = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        $response_time = round(curl_getinfo($curl,CURLINFO_TOTAL_TIME) * 100);

        if (curl_errno($curl)) {
            $error = [
                'status' => false,
                'error'  => [
                    'message'   => curl_error($curl) ?? "curl error"
                ],
                'http_code'     => $code,
                'response_time' => $response_time
            ];
        }
        curl_close($curl);

        if(empty($result)) return $error;

        $response = json_decode($result,true);

        if ($return_curl_info) $response = array_merge($response,['http_code' => $code,'response_time' => $response_time ]);

        return $response;
    }


    public function get($url, $params = [], $headers = [], $return_curl_info = false)
    {
        $headers = array_merge($headers,[
            'Content-Type:application/json',
            'Accept:application/json'
        ]);
        ini_set('memory_limit', '-1');
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL,$url.'?'.http_build_query($params));
        curl_setopt($curl, CURLOPT_TIMEOUT, 24);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 4);

        curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result        = curl_exec($curl);

        $code          = curl_getinfo($curl,CURLINFO_HTTP_CODE);

        $response_time = round(curl_getinfo($curl,CURLINFO_TOTAL_TIME) * 100);

        if (curl_errno($curl)) {
            $error = [
                'status' => false,
                'error'  => [
                    'message'   => curl_error($curl) ?? "curl error"
                ],
                'http_code'     => $code,
                'response_time' => $response_time
            ];
        }
        curl_close($curl);

        if(empty($result)) return $error;

        $response = json_decode($result,true);

        if ($return_curl_info) $response = array_merge($response,['http_code' => $code,'response_time' => $response_time ]);

        return $response;
    }
}