<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Traits\Applications\CheckApp;
use App\Traits\Personal\MyIdInfo;
use App\Models\Application as ApplicationModel;
use App\Http\Controllers\Controller;

class ClientInfoController extends Controller
{
    use ValidateMethod, CheckApp, MyIdInfo;

    private $application;

    public function __construct(ApplicationModel $model)
    {
        $this->application = $model;
    }

    public function clientInfo(Request $request){
        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);
        if ($validator->fails()) return $this->responseError('10422', $validator->messages());

        // Check application with @CheckApp trait
        $inspections = $this->checkApplication($request);
        if(!empty($inspections)) return $this->responseError($inspections->code, $inspections->message);
        $valid_data = $request->all();

        // Application's validated data update or create
        $app_info = $this->application->updateOrCreateApp($valid_data);
        if($app_info){
            $app_info->applicationInfo()->update([
               'person_photo' => $valid_data['person_photo']
            ]);
        }
        // AppIdentified - false(Not Identified)
        if($app_info->is_identified == false){
            // Identify Person with @MyIdInfo trait
            $responseData = $this->identifyPerson($app_info->applicationInfo->toArray());
            dd($responseData);
//            if(is_object($responseData) && $responseData instanceof \Illuminate\Http\JsonResponse){
//                $personInfo = $responseData->getData();
//                // Check Person Response Status 1-success
//                if($personInfo->status == 1 && property_exists($personInfo,'result') && !empty($personInfo->result)){
//                    return $this->responseSuccess($personInfo->result->code, $personInfo->result->message,[
//                        'passport_info' => ($personInfo->status) ? true : false,
//                        'key_app'       => $app_info->key_app
//                    ]);
//
//                // Check Person Response Status 0-error
//                }elseif($personInfo->status == 0 && property_exists( $personInfo,'error') && !empty($personInfo->error)){
//                    return $this->responseError($personInfo->error->code, $personInfo->error->message,[
//                        'passport_info' => ($personInfo->status) ? true : false,
//                        'key_app'       => $app_info->key_app
//                    ]);
//                }
//            }
        }
        // PersonInfo exists returns a successful response
        return $this->responseSuccess('10100','Ushbu mijoz identifikatsiyadan o\'tgan.',[
            'app_is_identified' => $app_info->is_identified,
            'key_app'           => $app_info->key_app
        ]);
    }
}