<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Validator;

trait ValidateMethod{
    static $rules = [];
    public function validate_method(Request $request, $method){
        switch ($method){
            case 'clientInfo':
                self::$rules = [
                    'serial_number'   => 'required|size:9',
                    'pin'             => 'required|size:14',
                    'person_photo'    => 'required',
                    'birth_date'      => 'nullable',
                    'partner_id'      => 'required|exists:api_users,id'
                ];
                break;
            case 'identifiedClientInfo':
                self::$rules = [
                    'profile'             => 'required',
                    'profile.common_data' => 'required',
                    'profile.doc_data'    => 'required',
                    'profile.address'     => 'required',
                    'person_photo'        => 'nullable'
                ];
                break;
            case 'cardInfo':
                self::$rules = [
                    'key_app'         => 'required|exists:applications,key_app',
                    'card_number'     => 'required|size:16',
                    'card_expire'     => 'required|size:4'
                ];
                break;
            case 'confirmLimit':
                self::$rules = [
                    'key_app'         => 'required|exists:applications,key_app',
                    'confirm'         => 'required|boolean'
                ];
                break;
            case 'confirmPayment':
                self::$rules = [
                    'key_app'         => 'required|exists:applications,key_app',
                    'otp'             => 'required'
                ];
                break;
            case 'confirmDelivery':
                self::$rules = [
                    'key_app'   => 'required|exists:applications,key_app',
                    'address'   => 'required'
                ];
                break;
            case 'appStatus':
            case 'appReject':
            case 'appPaymentStatus':
            case 'getCardInfo':
            case 'getPersonalInfo':
                self::$rules = [
                    'key_app'   => 'required|exists:applications,key_app'
                ];
                break;
            case 'updatePersonalInfo':
                self::$rules = [
                    'key_app'              => 'required|exists:applications,key_app',
                    'serial_number'        => 'required|size:9',
                    'pin'                  => 'required|size:14',
                    'inn'                  => 'required|size:9',
                    'name'                 => 'required',
                    'family_name'          => 'required',
                    'patronymic'           => 'required',
                    "gender"               => 'nullable',
                    'birth_date'           => 'nullable|date_format:Y-m-d',
                    'document_date'        => 'required|date_format:Y-m-d',
                    "document_region"      => 'required|size:2',
                    "document_district"    => 'required|size:3',
                    "registration_region"  => 'required|size:2',
                    "registration_district"=> 'required|size:3',
                    "registration_address" => 'nullable',
                    "live_address"         => 'nullable'
                ];
                break;
            case 'restoreGetToken':
                self::$rules = [
                    'card_number'          => 'required|size:16'
                ];
                break;
            case 'restoreCardInfo':
                self::$rules = [
                    'token'                => 'required|exists:card_restore_applications,token',
                    'salary_card_number'   => 'required|size:16',
                    'salary_card_expire'   => 'required|size:4',
                    'phone'                => 'required|size:9',
                    'reason_id'            => 'required',
                    'address'              => 'nullable|max:200',
                ];
                break;
            case 'restoreConfirmPayment':
                self::$rules = [
                    'token'                => 'required|exists:card_restore_applications,token',
                    'otp'                  => 'required|size:5',
                ];
                break;
            case 'restoreAppStatus':
                self::$rules = [
                    'token'                => 'required|exists:card_restore_applications,token',
                ];
                break;
        }
        return Validator::make($request->all(), self::$rules);
    }

}