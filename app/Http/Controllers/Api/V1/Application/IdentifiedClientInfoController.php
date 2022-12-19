<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Traits\Applications\CheckApp;
use App\Traits\Personal\MyIdInfo;
use App\Models\MyIdInfo as PersonalModel;
use App\Models\Application as ApplicationModel;
use App\Http\Controllers\Controller;

class IdentifiedClientInfoController extends Controller
{
    use ValidateMethod, CheckApp, MyIdInfo;

    private $application;

    public function __construct(ApplicationModel $model)
    {
        $this->application = $model;
    }

    public function identifiedClientInfo(Request $request){
        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);
        if ($validator->fails()) return $this->responseError('10422', $validator->messages());

        $request->merge([
            'serial_number' => $request->profile['doc_data']['pass_data'],
            'pin'           => $request->profile['common_data']['pinfl'],
        ]);
        // Check application with @CheckApp trait
        $inspections = $this->checkApplication($request);
        if(!empty($inspections)) return $this->responseError($inspections['code'], $inspections['message']);
        $valid_data = $request->all();
        // Application's validated data update or create
        $app_info = $this->application->updateOrCreateApp($valid_data);

        if($app_info && $app_info->is_identified == false){
            $app_info->applicationInfo()->update([
                'person_photo' => get_no_image(),
            ]);
            $personalData = PersonalModel::saveProfileMobile($valid_data);
            if($personalData){
                $app_info->update([
                    'is_identified' => true,
                    'status_id'     => 2, // Identification success,
                    'step'          => 1  // MyId Identification
                ]);
                return $this->responseSuccess('10100','Arizangiz identifikatiya qilindi',[
                    'app_is_identified' => $app_info->is_identified ? true : false,
                    'key_app'           => $app_info->key_app
                ]);
            }
        }
        return $this->responseSuccess('10101','Ushbu ariza identifikatiyadan o\'tgan',[
            'app_is_identified' => $app_info->is_identified ? true : false,
            'key_app'           => $app_info->key_app
        ]);
    }
}