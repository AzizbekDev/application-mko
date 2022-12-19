<?php
namespace App\Services\Unired;

use Log;
use App\Http\Traits\CurlRequest;
use App\Models\Settings;

class UzcardService
{
    use CurlRequest;
    private $base_url = "https://core.unired.uz/api/v1/unired";
    private $token    = '$2y$10$MfTug6env0D3OHA.JYH1feGntmVceljClQBy8HeGuuFirKbIY7b12';
    public function apply($card_number, $expire, $start_date, $end_date)
    {

    }
}