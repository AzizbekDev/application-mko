<?php
namespace App\Services\Unired;

use App\Traits\Logger;
use App\Http\Traits\CurlRequest;

class UniredService
{
    use CurlRequest, Logger;
    protected $base_url = 'https://mobile.unired.uz/mans/partner/mko/callback';

    public function send_wallet_push($data){
        $responseData = $this->post(
            $this->base_url,
            json_encode($data),
            ['Content-Type:application/json']
        );
        if(!is_null($responseData) || !empty($responseData)) $this->logger($responseData,'mobile');
        return $responseData;
    }
}
