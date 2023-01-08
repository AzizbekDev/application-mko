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
        // Get Application by key_app
        $app_info = $this->application->whereKeyApp($request->key_app)->first();
        // Application Exists
        if($app_info){
            // TODO: Card Check
            // TODO: Card Scoring

            // Card update need to remove Card Scoring
            $app_info->salaryCards()->updateOrCreate([
                'card_number'   => $request->card_number,
                'expire'        => $request->card_expire,
                'phone'         => $request->phone
            ]);
//            dd($this->credit_report($app_info->asokiClient->id));
            // Tax Get Info & Tax Scoring
            if($app_info->status_id == 5 || $app_info->status_id == 2 || $app_info->status_id == 6){
                $salary_info = $this->getTaxSalaryInfo($app_info->id);
                if($salary_info && $salary_info['success'] == false) return $this->responseError('30109', get_code_message('30109'));
                if($salary_info && $salary_info['success'] == true){
                    $average_salary = intval($salary_info['average_salary']);
                    if($average_salary != 0 && $average_salary >= 2000000){
                        $this->credit_report($app_info->asokiClient->id);
                        $limit = $this->get_limit($average_salary, $app_info->applicationInfo->birth_date);
                        $scoring_info = [
                            'limit'          => $limit,
                            'description'    => [
                                "uz"         => "Sizga boshlan'gich limit {$limit} so'm miqdorida mablag' ajratildi",
                                "ru"         => "Вам выделен стартовый лимит {$limit} сум",
                                "en"         => "You have been allocated a starting limit of {$limit} uzs"
                            ]
                        ];
                        $app_info->update([
                            'step'           => 2,
                            'status_id'      => 6,
                            'status_message' => 'Salary Scoring Success'
                        ]);
                        return $this->responseSuccess('30112', get_code_message('30112'), [
                            'data'    => $scoring_info,
                            'key_app' => $app_info->key_app
                        ]);
                    }else{
                        $app_info->update([
                            'step'           => 2,
                            'status_id'      => 5,
                            'status_message' => 'Salary Scoring Error'
                        ]);
                        return $this->responseError('30113', get_code_message('30113'), [
                            'data'    => null,
                            'key_app' => $app_info->key_app
                        ]);
                    }
                }else{
                    return $this->responseError('11111', get_code_message('11111'), [
                        'data'    => null,
                        'key_app' => $app_info->key_app
                    ]);
                }
            }
//            if($app_info->status_id == 7 || $app_info->status_id == 6){
//                // TODO: Credit Info
//
//                // TODO: Credit Scoring
//            }
            return $this->responseError('10006', get_code_message('10006'));
        }else{
            return $this->responseError('10006', get_code_message('10006'));
        }
    }
}