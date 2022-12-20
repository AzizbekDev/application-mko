<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Http\Controllers\Controller;
use App\Models\Application as ApplicationModel;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ConfirmLimitController extends Controller
{
    use ValidateMethod;
    private $application;

    public function __construct(ApplicationModel $model)
    {
        $this->application = $model;
    }

    public function confirmLimit(Request $request){
        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);
        if ($validator->fails()) return $this->responseError('10422', $validator->messages());
        $app_info = $this->application->whereKeyApp($request->key_app)->first();

        if($app_info->step == 4 && $app_info->status_id == 11) return $this->responseSuccess('10204', "Arizangiz qabul qilingan.");
        if($request->confirm){
            $clientInfo = [
                "password" => Str::random(5),
                "date_pub" => Carbon::now(),
            ];
            $app_info->client()->updateOrCreate($clientInfo);
            $app_info->update([
                "status_id"      => 11,
                "status_message" => "Client Opened",
                "step"           => 4 // Success Application
            ]);
            return $this->responseSuccess('10201', "Arizangiz qabul qilindi.");
        }else{
            $app_info->update([
                "status_id"      => 12,
                "status_message" => "Client Rejected",
                "step"           => 3 // Success Application
            ]);
            return $this->responseSuccess('10203', "Arizangiz bekor qilindi.");
        }

    }
}