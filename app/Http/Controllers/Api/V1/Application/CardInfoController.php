<?php

namespace App\Http\Controllers\Api\V1\Application;

use Illuminate\Http\Request;
use App\Http\Traits\ValidateMethod;
use App\Traits\Personal\TaxInfo;
use App\Traits\Personal\KatmInfo;
use App\Traits\Scoring\LimitScoring;
use App\Http\Controllers\Controller;
use App\Models\KatmScoring;
use App\Models\Application as ApplicationModel;

class CardInfoController extends Controller
{
    use ValidateMethod, TaxInfo, KatmInfo, LimitScoring;
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
                'step'      => 2, // Card/Salary/Credit Scoring
                'status_id' => 4,
                'status_message' => "Card Scoring Success"
            ]);
        }
        $app_info->salaryCards()->updateOrCreate([
            'card_number'   => $request->card_number,
            'expire'        => $request->card_expire,
            'phone'         => $request->phone
        ]);
        // Credit Report send request
        $this->credit_report($app_info->asokiClient->id);
        if($app_info->step = 2 && $app_info->status_id >= 6){
            return $this->responseSuccess('10112', 'Scoringdan o\'tdi', [
                'key_app' => $app_info->key_app,
                'data'    => [
                    'salary_average' => $this->getAverageSalary(['serial_number' => $app_info->serial_number]),
                        'min_limit'  => $this->getAverageSalary(['serial_number' => $app_info->serial_number]),
                        'max_limit'  => 26000000
                    ]
                ]);
        }else{
            $salary_info = $this->getTaxSalaryInfo($app_info->id);
            if($salary_info && array_key_exists('success', $salary_info) && $salary_info['success'] == false) return $this->responseError('10105', $salary_info['reason']);
            if($salary_info && $salary_info['success']){
                $average_salary = intval($salary_info['average_salary']);
                if($average_salary != 0 && $average_salary >= 2000000){
                    $scoring_info = [
                        'salary_average' => $average_salary,
                            'min_limit'      => $this->get_limit($average_salary, $app_info->applicationInfo->birth_date),
                            'max_limit'      => 26000000
                    ];
                    $app_info->update([
                        'step' => 2,
                        'status_id' => 6,
                        'status_message' => 'Salary Scoring Success'
                    ]);
                    return $this->responseSuccess('10111', 'Scoringdan o\'tdi', [
                        'key_app' => $app_info->key_app,
                        'data'    => $scoring_info
                    ]);
                }else{
                    $app_info->update([
                        'step'           => 2,
                        'status_id'      => 5,
                        'status_message' => 'Salary Scoring Error'
                    ]);
                    return $this->responseError('10112', 'Scoringdan o\'tmadi', [
                        'key_app' => $app_info->key_app,
                        'data'    => [
                            'salary_average' => $average_salary,
                                'min_limit'      => 0,
                                'max_limit'      => 0
                        ]
                    ]);
                }
            }else{
                return $this->responseError('10112', 'Scoringdan o\'tmadi', [
                    'key_app' => $app_info->key_app,
                    'data'    => [
                        'salary_average' => $this->getAverageSalary([
                            'serial_number' => $app_info->serial_number
                        ]),
                        'min_limit'      => 0,
                        'max_limit'      => 0
                    ]
                ]);
            }
        }
    }
}