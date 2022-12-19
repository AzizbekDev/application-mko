<?php

namespace App\Http\Controllers\Api\V1\Unired;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiMethod;
use App\Traits\Personal\TaxInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    use TaxInfo, ApiMethod;

    protected function getSalaryInfo(Request $request){
        $v = Validator::make($request->all(), [
            'serial_number' => 'nullable|size:9',
            'inn'           => 'nullable|size:9',
            'pin'           => 'nullable|size:14',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        return $this->getTaxSalaryInfo($request->all());
    }

    protected function getScoringInfo(Request $request){
        $v = Validator::make($request->all(), [
            'serial_number' => 'nullable|size:9',
            'inn'           => 'nullable|size:9',
            'pin'           => 'nullable|size:14',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        dd('scoring not implemented yet');
    }

}