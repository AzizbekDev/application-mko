<?php
namespace App\Traits\Personal;

use App\Models\MyIdInfo;
use App\Models\Application;
use App\Models\AsokiClient;
use App\Services\Katm\KatmService;

trait KatmInfo{

    public function create_client($application_id)
    {
        $application   = Application::find($application_id);
        $client        = AsokiClient::whereClaimId($application->id)->latest()->first();
        if($client && $client->status_id == 2) return json_decode($client->response_info,'true');
        $passport      = MyIdInfo::wherePassData($application->serial_number)->first();
        $profile       = json_decode($passport->profile, 'true');
        $data = [
            "claim_id"              => $application->id,
            'claim_date'            => $application->updated_at->format('d.m.Y'),
            'claim_number'          => (string)$application->id,
            'agreement_number'      => (string)$application->id,
            'agreement_date'        => $application->updated_at->format('d.m.Y'),
            'phone'                 => $application->phone,
            'resident'              => '1',
            'client_type'           => '08',
            'nibbd'                 => '00000000',
            'document_serial'       => extract_passport_seria($profile['doc_data']['pass_data']),
            'document_number'       => extract_passport_number($profile['doc_data']['pass_data']),
            'inn'                   => $profile['common_data']['inn'],
            'pin'                   => $profile['common_data']['pinfl'],
            'gender'                => $profile['common_data']['gender'],
            'birth_date'            => $profile['common_data']['birth_date'],
            'family_name'           => $profile['common_data']['last_name_en'],
            'name'                  => $profile['common_data']['first_name_en'],
            'patronymic'            => removeMarks($profile['common_data']['middle_name']),
            'document_date'         => $profile['doc_data']['issued_date'],
            'document_type'         => $profile['doc_data']['doc_type_id_cbu'],
            'document_region'       => $profile['address']['permanent_registration']['region_id_cbu'],
            'document_district'     => $profile['address']['permanent_registration']['district_id_cbu'],
            'registration_region'   => $profile['address']['permanent_registration']['region_id_cbu'],
            'registration_district' => $profile['address']['permanent_registration']['district_id_cbu'],
            'registration_address'  => convert_text_latin($profile['address']['permanent_address']),
            'live_address'          => convert_text_latin($profile['address']['permanent_address']),
            'registration_cadastr'  => '',
            'live_cadastr'          => '',
            'katm_sir'              => ''
        ];

        $creditService = (new KatmService())->inquiry_individual($data);

        if($creditService && $creditService['result']['code'] == '05000'){
            $dataResponse = [
                'katm_sir'       => $creditService['response']['katm_sir'],
                'status_id'      => 2,
                'status_message' => 'Success Info',
                'response_info'  => json_encode($creditService)
            ];
        }else{
            $dataResponse = [
                'status_id'      => 3,
                'status_message' => 'Error',
                'response_info'  => json_encode($creditService)
            ];
        }

        if($client){
            $client->update(array_merge($data,$dataResponse));
        }else{
            AsokiClient::create(array_merge($data,$dataResponse));
        }
        return $creditService;
    }

    public function credit_report($claim_id)
    {
        $client = AsokiClient::whereClaimId($claim_id)->latest()->first();
        if($client->info && $client->info->status_id == 2) return json_decode($client->info->info,'true');
        $creditService = (new KatmService())->credit_report($claim_id);
        if ($creditService && $creditService['code'] == 200) {
            if ($creditService['data']['result'] == '05000') {
                $dataResponse = [
                    'token'          => $creditService['data']['token'],
                    'status_id'      => 2,
                    'status_message' => 'Success',
                    'info'           => base64_decode($creditService['data']['reportBase64']),
                    'response_info'  => json_encode([
                        "data" => [
                            "result"        => $creditService['data']['result'],
                            "resultMessage" => $creditService['data']['resultMessage'],
                            "token"         => $creditService['data']['token'],
                        ],
                        "errorMessage"      => $creditService['errorMessage'],
                        "code"              => $creditService['code'],
                    ])
                ];
            } elseif ($creditService['data']['result'] == '05050') {
                $dataResponse = [
                    'token'          => $creditService['data']['token'],
                    'status_id'      => 5,
                    'status_message' => 'Awaits Confirmation',
                    'response_info'  => json_encode($creditService)
                ];
            }else{
                $dataResponse = [
                    'status_id' => 3,
                    'status_message' => 'Error',
                    'response_info' => json_encode($creditService)
                ];
            }
            $client->info()->updateOrCreate(['claim_id' => $claim_id],$dataResponse);
        }
        return $creditService;
    }

    public function credit_report_status($data){
        $creditService = new KatmService();
    }
}