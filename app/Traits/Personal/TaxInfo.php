<?php
namespace App\Traits\Personal;

use App\Models\PersonalInfo;
use App\Services\Tax\TaxService;
use App\Traits\Personal\CheckPerson;

trait TaxInfo{
    use CheckPerson;
    static $statusSuccess = '2';
    static $source = ["TaxInfo" => 3,"DigID" => 2, "GSP" => 1];
    static $statusSuccessMessage = 'Success Info';

    public function getTaxInfo($data){
        $check_info = $this->checkPerson($data);
        if($check_info){
            return $this->responseSuccess('30110',
                $check_info['status_message'] ?? 'No message',['personal_info' => $check_info]);
        }else{
            $tax_info = (new TaxService())->getPersonalInfo($data);
            if($tax_info
                && array_key_exists('success', $tax_info)
                && array_key_exists('reason', $tax_info)
                && array_key_exists('data', $tax_info)){
                if($tax_info['success'] && $tax_info['data']){
                    $this->updatePersonInfo($tax_info['data']);
                    return $this->responseSuccess('30110', $tax_info['data']);
                }else{
                    return $this->responseSuccess('30113', $tax_info['reason']);
                }
            }
            return $this->responseSuccess('30115', 'Service "Tax" is not working... :(');
        }
    }

    public function updatePersonInfo($dataTax){
        $person_info = [
            'serial_number'         => $dataTax['series_passport'].str_pad($dataTax['number_passport'],7, "0", STR_PAD_LEFT ),
            'pin'                   => $dataTax['pinfl'],
            'inn'                   => $dataTax['tin'],
            'birth_date'            => date_format_store(extract_passport_birth_date($dataTax['pinfl'])),
            'document_date'         => date_format_store($dataTax['issued_passport']),
            'document_region'       => str_pad($dataTax['ns10_code'],2, "0", STR_PAD_LEFT ),
            'document_district'     => str_pad($dataTax['ns11_code'],3, "0", STR_PAD_LEFT ),
            'family_name'           => extract_full_name($dataTax['company_name'])['family_name'],
            'name'                  => extract_full_name($dataTax['company_name'])['name'],
            'patronymic'            => extract_full_name($dataTax['company_name'])['patronymic'],
            'registration_region'   => str_pad($dataTax['ns10_code'],2, "0", STR_PAD_LEFT ),
            'registration_district' => str_pad($dataTax['ns11_code'],3, "0", STR_PAD_LEFT ),
            'registration_address'  => $dataTax['adress'],
            'live_address'          => $dataTax['adress'],
            'gender'                => extract_passport_gender($dataTax['pinfl']),
            'status_id'             => self::$statusSuccess,
            'status_message'        => self::$statusSuccessMessage,
            'response_info'         => json_encode($dataTax),
            'response_source'       => self::$source['TaxInfo'],
        ];
        return PersonalInfo::updateOrCreate(['serial_number' => $person_info['serial_number'], 'pin' => $person_info['pin']], $person_info);
    }
}