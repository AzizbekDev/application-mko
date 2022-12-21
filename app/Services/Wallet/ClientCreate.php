<?php
namespace App\Services\Wallet;

use App\Http\Traits\CurlRequest;
use App\Traits\Logger;

class ClientCreate
{
    use CurlRequest, Logger;

    protected $base_url = 'https://wallet-mko.unired.uz/api/v1/gw';
    protected $token    = 'oitjmx8H3ePdFzJ3pnIlgqKMwD77efjnmnl2PjARo407xTHI1OwuwPTrAGrfmI2yBgU61SwdaB9f9IEC';

    public function apply($data){
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->token
        ];
        $params = json_encode([
            "jsonrpc" => "2.0",
            "id"      =>  create_guid(),
            "method"  => "client.create",
            "params"  =>  $data
        ]);
        $response = $this->post($this->base_url, $params, $headers);
        return $response;
    }
}