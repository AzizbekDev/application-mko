<?php

namespace App\Http\Controllers\Api\V1\Card;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Services\Card\Monitoring;
use App\Http\Traits\ApiMethod;

class SvGateController extends Controller
{
    use ApiMethod;

    protected function cardMonitoring(Request $request){
        $v = Validator::make($request->all(), [
            'card_number'=> 'required|size:16',
            'expire'     => 'required|size:4',
            'start_date' => 'required',
            'end_date'   => 'required',
            'page_size'  => 'required',
            'page_number'=> 'required',
        ]);
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());
        // TODO working svgate
        return (new Monitoring())->get_monitoring($request->all());
    }


}