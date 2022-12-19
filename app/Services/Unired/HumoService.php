<?php
namespace App\Services\Unired;

use Log;
use App\Http\Traits\CurlRequest;
use App\Models\Settings;

class HumoService
{
    use CurlRequest;
    private $base_url = "https://core.unired.uz/api/v1/humo";
    private $token    = '$2y$10$MfTug6env0D3OHA.JYH1feGntmVceljClQBy8HeGuuFirKbIY7b12';

    public function apply($card_number, $expire, $start_date, $end_date)
    {
        $headers = [
          'Unisoft-Authorization: '.$this->token
        ];
        $params  = json_encode([
            'id'     => "1",
            "method" => "humo.monitoring",
            "params" => [
                "card_number" => $card_number,
                "expire"      => $expire,
                "start_date"  => $start_date,
                "end_date"    => $end_date
            ]
        ]);
        $response = $this->post($this->base_url, $params,$headers,true);
        return $response;
    }
}