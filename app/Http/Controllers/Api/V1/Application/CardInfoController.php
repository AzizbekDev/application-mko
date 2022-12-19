<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Traits\Personal\TaxInfo;
use App\Http\Controllers\Controller;
use App\Models\Application as ApplicationModel;

class CardInfoController extends Controller
{
    use ValidateMethod, TaxInfo;
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

        $app_info = $this->application->whereKeyApp($request->key_app)->first();
        if($app_info){
            $app_info->update([
                'card_mask' => $request->card_number,
                'phone'     => $request->phone,
                'status_id' => 4,
                'status_message' => "Card Scoring Success"
            ]);
        }
        $app_info->salaryCards()->updateOrCreate([
            'card_number'   => $request->card_number,
            'expire'        => $request->card_expire,
            'phone'         => $request->phone
        ]);
        $salary_info = $this->getTaxSalaryInfo([
            'serial_number' => $app_info->serial_number
        ]);
        if($salary_info && array_key_exists('success', $salary_info) && $salary_info['success'] == false) return $this->responseError('10105', $salary_info['reason']);
        if($salary_info && $salary_info['success']){
            $scoring_info = [
                'salary_average' => intval($salary_info['average_salary']),
                'min_limit'      => 3000000,
                'max_limit'      => 24000000
            ];
            return $this->responseSuccess('10111', 'Scoringdan o\'tdi', [
                'data' => $scoring_info
            ]);
        }else{
            return $this->responseError('10112', 'Scoringdan o\'tmadi', [
                'salary_average' => $salary_info['salary_average'],
                'min_limit'      => 0,
                'max_limit'      => 0
            ]);
        }
    }
}