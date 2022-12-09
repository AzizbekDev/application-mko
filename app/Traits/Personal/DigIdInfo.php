<?php
namespace App\Traits\Personal;

use App\Models\PersonalInfo;
use App\Traits\Personal\CheckPerson;
use App\Services\DigID\DigIdService;

trait DigIdInfo{

    use CheckPerson;
    static $successAnswer = 0;

    public function getDigIdInfo($data){
        $person_info = $this->checkPerson($data);
        if($person_info){
            if($person_info->status_id == 2){
                return $this->responseSuccess(
                    '30110',
                    $person_info->status_message,
                    ['response' => json_decode($person_info->response_info, true)]
                );
            }else{
                return $this->responseError(
                    '30113',
                    $person_info->status_message,
                    ['response' => json_decode($person_info->response_info, true)]
                );
            }
        }else{
            $digit_info = (new DigidService())->getPassportInfo($data);
            if($digit_info
                && array_key_exists('code', $digit_info)
                && array_key_exists('message', $digit_info)
                && array_key_exists('response', $digit_info)){
                if($digit_info['code'] == self::$successAnswer && $digit_info['response']['answere']['AnswereId'] == self::$successAnswer){
                    $person_info = $this->updateDigIdInfo($digit_info['response']);
                    if($person_info && $person_info->status_id == 2){
                        return $this->responseSuccess(
                            '30110',
                            $person_info->status_message,
                            ['response' => json_decode($person_info->response_info, true)]
                        );
                    }else{
                        return $this->responseError(
                            '30113',
                            $person_info->status_message,
                            ['response' => json_decode($person_info->response_info, true)]
                        );
                    }
                }else{
                    return $this->responseError(
                        '30113',
                        $digit_info['message']." Code:".$digit_info['code'],
                        ['response' => $digit_info['response']]
                    );
                }
            }
        }
    }

    public function updateDigIdInfo($data)
    {
        $dataUpdate = [
            'serial_number'         => $data['Person']['DocumentSerialNumber'],
            'pin'                   => $data['Person']['Pinpp'],
            'inn'                   => !empty($data['Additional']['Inn']) ? $data['Additional']['Inn'] : null,
            'birth_date'            => date_format_store($data['Person']['BirthDate']),
            'document_date'         => date_format_store($data['Person']['DocumentDateIssue']),
            'document_region'       => ($data['Address']['answere']['AnswereId'] == 0)
                ? str_pad($data['Address']['Address']['Region'],2, "0", STR_PAD_LEFT ) : "00",
            'document_district'     => ($data['Address']['answere']['AnswereId'] == 0)
                ? str_pad($data['Address']['Address']['District'],3, "0", STR_PAD_LEFT ) : "000",
            'family_name'           => removeMarks($data['Person']['SurnameL']),
            'name'                  => removeMarks($data['Person']['NameL']),
            'patronymic'            => removeMarks($data['Person']['PatronymL']),
            'registration_region'   => ($data['Address']['answere']['AnswereId'] == 0)
                ? str_pad($data['Address']['Address']['Region'],2, "0", STR_PAD_LEFT ) : "00",
            'registration_district' => ($data['Address']['answere']['AnswereId'] == 0)
                ? str_pad($data['Address']['Address']['District'],3, "0", STR_PAD_LEFT ) : "000",
            'registration_address'  => ($data['Address']['answere']['AnswereId'] == 0) ? removeMarks($data['Address']['Address']['Address']) : null,
            'live_address'          => ($data['Address']['answere']['AnswereId'] == 0) ? removeMarks($data['Address']['Address']['Address']) : null,
            'gender'                => $data['Person']['Sex'],
            'status_id'             => 2, // Success
            'status_message'        => 'Success',
            'response_source'       => 2, //DIGIT
            'response_info'         => json_encode($data),
            'person_photo'          => array_key_exists('ModelPersonPhoto', $data) ? $data['ModelPersonPhoto']['PersonPhoto'] : null
        ];
        if($data['Address']['answere']['AnswereId'] != 0 || empty($data['Additional']['Inn'])){
            $dataUpdate['status_id']      = 4; // Incomplete person info
            $dataUpdate['status_message'] = 'Incomplete person info';
        }
        return PersonalInfo::updateOrCreatePerson($dataUpdate);
    }
}