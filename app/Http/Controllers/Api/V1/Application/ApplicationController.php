<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Models\Application as ApplicationModel;
use App\Models\PersonalInfo as PersonalInfoModel;
use App\Http\Controllers\Controller;
use App\Http\Resources\Application\PersonalInfoResource;

class ApplicationController extends Controller
{
    use ValidateMethod;
    private $application;

    public function __construct(ApplicationModel $model)
    {
        $this->application = $model;
    }

    public function getPersonalInfo(Request $request){
        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);
        if ($validator->fails()) return $this->responseError('10422', $validator->messages());
        $valid_data  = $request->all();

        // Getting Application Personal Info By KeyApp form @Application model
        $application = $this->application->getPersonalInfoByKeyApp($valid_data);
        if($application && $application->personal_info){
            return $this->responseSuccess('10102', 'Person info found.',[
                'passport_info' => new PersonalInfoResource($application->personal_info),
                'key_app'       => $application->key_app
            ]);
        }
        return $this->responseError('10102', 'Person info not found.',[
            'passport_info' => null,
            'key_app'       => $application->key_app
        ]);
    }

    public function updatePersonalInfo(Request $request){

        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);
        if ($validator->fails()) return $this->responseError('10422', $validator->messages());
        $valid_data  = $request->all();

        // Checking Passport Info data is full
        if($valid_data['document_region']           == '00'
            || $valid_data['document_district']     == '000'
            || $valid_data['registration_region']   == '00'
            || $valid_data['registration_district'] == '000'
            || $valid_data['inn']                   == '000000000'
            || $valid_data['inn']                   == '123456789'
            || $valid_data['inn']                   == '111111111'){
            $dataUpdate['status_id']      = 4; // Incomplete person info
            $dataUpdate['status_message'] = 'Incomplete person info';
            $dataUpdate                   = array_merge($dataUpdate, $valid_data);
        }else{
            $dataUpdate['status_id']      = 2; // Success
            $dataUpdate['status_message'] = 'Success';
            $dataUpdate                   = array_merge($dataUpdate, $valid_data);
        }
        $data = PersonalInfoModel::updateOrCreatePerson($dataUpdate);
        if($data && $data->status_id == 2){
            return $this->responseSuccess('10102', $data->status_message,[
                'passport_info' => true,
                'key_app'       => $request->key_app
            ]);
        }
        return $this->responseError('10102', $data->status_message ?? 'Incomplete person info.',[
            'passport_info' => false,
            'key_app'       => $request->key_app
        ]);
        //testing
    }
}