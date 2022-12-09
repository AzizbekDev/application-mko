<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Http\Controllers\Controller;
use App\Models\Application as ApplicationModel;

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
        $valid_data = $request->all();
        dd($valid_data);
    }
}