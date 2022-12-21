<?php
namespace App\Services\Katm;

class KatmService
{
    protected $createClaimUrl;
    protected $reportUrl;
    protected $reportStatusUrl;
    protected $katmUrl;
    protected $asokiUrl;
    protected $security;

    public function __construct(){
        $this->settings = json_decode(get_settings_value_by_name('katm'), true);
        $this->security = [
            'pLogin'    => "universalbank",
            'pPassword' => "j8apoiIOm#q"
        ];
        $this->katmUrl         = $this->settings['katm_url'];
        $this->asokiUrl        = $this->settings['asoki_url'];
        $this->createClaimUrl  = "http://10.22.50.3:8000/inquiry/individual";
        $this->reportUrl       = "http://10.22.50.3:8001/katm-api/v1/credit/report";
        $this->reportStatusUrl = "http://10.22.50.3:8001/katm-api/v1/credit/report/status";
    }

    public function inquiry_individual($data){
        $data['claim_id'] = '+000'.$data['claim_id'];
        $json = json_encode([
            'header'    => [
                'type'  => 'B',
                "code"  => "00996"
            ],
            'request'   => $data
        ]);
        $result = $this->sendRequest($this->createClaimUrl, $json);
        return $result;
    }

    public function credit_report($claim_id){
        $claim_id = '+000'.$claim_id;
        $data = [
            "pHead"         => "048",
            "pCode"         => "00996",
            "pClaimId"      => $claim_id,
            "pReportId"     => 001,
            "pReportFormat" => 1
        ];
        $json = json_encode([
            "security"      => $this->security,
            "data"          => $data
        ]);
        $result = $this->sendRequest($this->reportUrl, $json);
        return $result;
    }

    public function credit_report_status($claim_id, $token){
        $claim_id = '+000'.$claim_id;
        $data = [
            "pHead"         => "048",
            "pCode"         => "00996",
            "pToken"        => $token,
            "pClaimId"      => $claim_id,
            "pReportFormat" => 1
        ];
        $json = json_encode([
            "security"      => $this->security,
            "data"          => $data
        ]);
        $result = $this->sendRequest($this->reportStatusUrl, $json);
        return $result;
    }

    public function credit_claim_decline($info){
        $data = [
            "pHead"              => "048",
            "pCode"              => "00996",
            "pDeclineDate"       => $info['date'],
            "pClaimId"           => '+000'.$info['claim_id'],
            "pDeclineNumber"     => $info['id'],
            "pDeclineReason"     => $info['reason'],
            "pDeclineReasonNote" => $info['note']
        ];
        $json = json_encode([
            "security"      => $this->security,
            "data"          => $data
        ]);
        $result = $this->sendRequest($this->climeDecline, $json);
        return $result;
    }

    public function customer_info($info){
        $data = [
            "pPinfl"         => $info['pin'],
            "pDocSeries"     => $info['serial'],
            "pDocNumber"     => $info['number'],
            "requestAddress" => 0
        ];
        $json = json_encode([
            "security"      => $this->security,
            "data"          => $data
        ]);
        $result = $this->sendRequest($this->clientInfo, $json);
        return $result;
    }

    protected function sendRequest($url, $request){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result         = curl_exec($curl);
        $error          = curl_error($curl);
        $result_decode  = json_decode($result, true);
        curl_close( $curl );
        if(json_last_error() && $error){
            return array('error' => true);
        }
        return $result_decode;
    }
}