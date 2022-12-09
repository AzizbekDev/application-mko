<?php

namespace App\Http\Controllers\Api\V1\Unired;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiMethod;
use App\Traits\Personal\DigIdInfo;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DigitController extends Controller
{
    use ApiMethod, DigIdInfo;

    protected function getPersonalInfo(Request $request){
        $v = Validator::make($request->all(), [
            'serial_number' => 'required|size:9',
            'pin'           => 'required|size:14',
            'inn'           => 'nullable|size:9',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        return $this->getDigIdInfo($request->all());
    }
}