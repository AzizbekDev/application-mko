<?php
namespace App\Services\Unired;

use Log;
use App\Http\Traits\CurlRequest;

class UniredService
{
    protected $mobile_url = 'https://mobile.unired.uz/mans/partner/callback';

    public function send_wallet_push($data){
        $response = $this->post($this->mobile_url, json_encode($data),['Content-Type:application/json']);
        return $response;
    }
}
