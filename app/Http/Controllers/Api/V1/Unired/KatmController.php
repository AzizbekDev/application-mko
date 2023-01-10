<?php

namespace App\Http\Controllers\Api\V1\Unired;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiMethod;
use App\Traits\Personal\KatmInfo;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KatmController extends Controller
{
    use KatmInfo, ApiMethod;

    protected function createClient (Request $request){
        $v = Validator::make($request->all(), [
            'client' => 'nullable|size:9',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        dd($request->all());
        return $this->getTaxSalaryInfo($request->all());
    }

    protected function creditReport (Request $request){
        $v = Validator::make($request->all(), [
            'key_app' => 'required'
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        $application = Application::whereKeyApp($request->key_app)->first();
        if($application){
            return $this->credit_report($application->asokiClient->claim_id);
        }else{
            return $application->asokiClient;
        }

    }

    protected function creditReportStatus(Request $request){
        $v = Validator::make($request->all(), [
            'serial_number' => 'nullable|size:9',
            'inn'           => 'nullable|size:9',
            'pin'           => 'nullable|size:14',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
    }

}