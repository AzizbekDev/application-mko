<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Traits\Cards\CheckCard;
use App\Models\Application as ApplicationModel;
use App\Http\Controllers\Controller;

class CardInfoController extends Controller
{
    use ValidateMethod, CheckCard;
    private $application;

    public function __construct(ApplicationModel $model)
    {
        $this->application = $model;
    }

    /***
     * @desc Online Application API for client_info
     * @param Request $request
     * @return mixed
     */
    public function cardInfo(Request $request){
        // Validate Request with @ValidateMethod trait
        $validator = $this->validate_method($request, __FUNCTION__);

        if ($validator->fails()) return $this->responseError('10422', $validator->messages());

        $valid_data = $request->all();

        $this->checkCard($valid_data);

    }
}