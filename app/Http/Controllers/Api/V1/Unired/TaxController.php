<?php

namespace App\Http\Controllers\Api\V1\Unired;

use App\Http\Controllers\Controller;
use App\Traits\Personal\TaxInfo;
use App\Http\Traits\ApiMethod;
use App\Services\Tax\TaxService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TaxController extends Controller
{
    use TaxInfo, ApiMethod;

    protected function getPersonalInfo(Request $request){
        $v = Validator::make($request->all(), [
            'serial_number' => 'nullable|size:9',
            'inn'           => 'nullable|size:9',
            'pin'           => 'nullable|size:14',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        return $this->getTaxInfo($request->all());
    }

    protected function getSalaryInfo(Request $request){
        $v = Validator::make($request->all(), [
            'serial_number' => 'nullable|size:9',
            'inn'           => 'nullable|size:9',
            'pin'           => 'nullable|size:14',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        return (new TaxService())->getSalaryInfo($request->all());
    }

    protected function getScoringInfo(Request $request){
        dd($request->all());
    }

    public function references($code){
        return (new TaxService())->getReference($code);
    }

}