<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Traits\Applications\CheckApp;
use App\Traits\Applications\UploadImage;
use App\Models\Application as ApplicationModel;
use App\Traits\Unired\UniPersonIdentifier;
use App\Http\Controllers\Controller;

class ClientInfoController extends Controller
{
    use ValidateMethod, CheckApp, UploadImage, UniPersonIdentifier;
    private $application;

    public function __construct(ApplicationModel $model)
    {
        $this->application = $model;
    }

    /***
     * @desc Online Application API for client_info
     * @param Request $request
     * @return mixed
     */
    public function clientInfo(Request $request){

        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);
        if ($validator->fails()) return $this->responseError('10422', $validator->messages());

        // Check application
        $inspections = $this->checkApplication($request);
        if($inspections && $inspections->status) return $this->responseError($inspections->code, $inspections->message);

        // Upload images return (array) valid data of request with generated new image name
        $valid_data = $this->uploadImage($request);

        // Application's validated data update or create
        $app_info = $this->application->updateOrCreateApp($valid_data);

        // Step/StatusID - 0(New application), StatusID - 1(Passport info not found)
        if($app_info->step == 0 && $app_info->status_id <= 1){

            // Get passport info from UniIdentifyPerson trait
            $responseData = $this->identifyPerson($valid_data);
            if(is_object($responseData) && $responseData instanceof \Illuminate\Http\JsonResponse){

                $personInfo = $responseData->getData();
                // Check Person Response Status 1-success
                if($personInfo->status == 1 && property_exists($personInfo,'result') && !empty($personInfo->result)){
                    return $this->responseSuccess($personInfo->result->code, $personInfo->result->message,[
                        'passport_info' => ($personInfo->status) ? true : false,
                        'key_app'       => $app_info->key_app
                    ]);

                // Check Person Response Status 0-error
                }elseif($personInfo->status == 0 && property_exists( $personInfo,'error') && !empty($personInfo->error)){
                    return $this->responseError($personInfo->error->code, $personInfo->error->message,[
                        'passport_info' => ($personInfo->status) ? true : false,
                        'key_app'       => $app_info->key_app
                    ]);
                }
            }
        }
        // PersonInfo exists returns a successful response
        return $this->responseSuccess('10100','Passport ma\'lumotlari tasdiqlangan.',[
            'passport_info' => true,
            'key_app'       => $app_info->key_app
        ]);
    }
}