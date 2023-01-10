<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Traits\ValidateMethod;
use App\Http\Controllers\Controller;
use App\Models\Application as ApplicationModel;
use App\Traits\Personal\KatmInfo;
use App\Traits\Scoring\LimitScoring;
use Carbon\Carbon;

class ConfirmLimitController extends Controller
{
    use ValidateMethod, KatmInfo, LimitScoring;
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
//        $this->credit_report_status($app_info->asokiClient->id);
        if($app_info->step == 4 && $app_info->status_id == 11) return $this->responseSuccess('10000', get_code_message('10000'));
        if($request->confirm){
            $limit = $this->get_limit($app_info->tax->average_salary, $app_info->applicationInfo->birth_date);
            $clientInfo = [
                "password"     => Str::random(5),
                "date_pub"     => Carbon::now(),
                "client_limit" => $limit
            ];
            // Credit Report Status send request
            $app_info->client()->updateOrCreate($clientInfo);
            $app_info->update([
                "status_id"      => 11,
                "status_message" => "Client Opened",
                "step"           => 4 // Success Application
            ]);
            return $this->responseSuccess('40100', get_code_message('40100'
            ));
        }else{
            $app_info->update([
                "status_id"      => 12,
                "status_message" => "Client Rejected",
                "step"           => 3 // Success Application
            ]);
            return $this->responseSuccess('40102', get_code_message('40102'));
        }

    }
}