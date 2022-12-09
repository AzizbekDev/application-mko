<?php

namespace App\Http\Controllers\Api\V1\Card;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\Holds\RestoreCardPayment as CardPaymentHold;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiMethod;

class HoldController extends Controller
{
    use ApiMethod, CardPaymentHold;

    protected function holdCreate(Request $request){
        $v = Validator::make($request->all(), [
            'card_number' => 'required|size:16',
            'card_expire' => 'required|size:4',
            'amount'      => 'required',
        ]);
        
        if ($v->fails()) return $this->responseError('30110',$v->errors()->all());

        dd($this->hold_create($request->all()));

        return $this->responseSuccess('10322',$request->all());
    }


}