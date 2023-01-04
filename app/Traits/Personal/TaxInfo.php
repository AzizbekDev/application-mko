<?php
namespace App\Traits\Personal;

use App\Models\Application;
use App\Models\TaxInfo as TaxModel;
use App\Services\TaxService;
use Illuminate\Support\Collection;
use Carbon\Carbon;
trait TaxInfo{
    static $statusSuccess  = 1;
    static $messageSuccess = 'Success';

    public function getTaxSalaryInfo($application_id){
        $application   = Application::find($application_id);
        if($application->tax && $application->tax->status_id == 1){
            return [
                "success"        => true,
                "reason"         => null,
                "average_salary" => $application->tax->average_salary,
                "data"           => $application->tax->details->toArray()
            ];
        }else {
            $response = (new TaxService())->getSalaryInfo([
                'serial_number' => $application->serial_number,
                'pin'           => $application->pin
            ]);
            if ($response && array_key_exists('success', $response)) {
                if ($response['success'] && !empty($response['data'])) {
                    $tax_info = $application->tax()->updateOrCreate([
                        'tin' => $response['data'][0]['tin'],
                        'pinfl' => $response['data'][0]['pinfl'],
                        'serial_number' => $response['data'][0]['series_passport'] . str_pad($response['data'][0]['number_passport'], 7, '0', STR_PAD_LEFT),
                    ], [
                        'ns10_code' => $response['data'][0]['ns10_code'],
                        'ns11_code' => $response['data'][0]['ns11_code'],
                        'last_year' => (int)Carbon::now()->format('Y'),
                        'last_period' => (int)Carbon::now()->format('m'),
                        'status_id' => self::$statusSuccess,
                        'status_message' => self::$messageSuccess,
                    ]);
                    $details = new Collection();
                    foreach ($response['data'] as $data){
                        $details->push([
                            "company_name" => $data['company_name'],
                            "company_tin" => $data['company_tin'],
                            "year" => $data['year'],
                            "period" => $data['period'],
                            "salary" => intval($data['salary']),
                            "salary_tax_sum" => intval($data['salary_tax_sum']),
                            "inps_sum" => intval($data['inps_sum']),
                            "prop_income" => intval($data['prop_income']),
                            "other_income" => intval($data['other_income']),
                        ]);
                    }
                    $average_salary = $details->groupBy('company_tin')->map(function ($company) {
                        return $company->slice(-6, 6)->avg('salary');
                    })->avg();
                    $application->tax()->update([
                        'average_salary' => intval($average_salary)
                    ]);
                    $tax_info->details()->delete();
                    $tax_info->details()->createMany($details->toArray());
                }
                return array_merge($response, ['average_salary' => $average_salary ?? 0]);
            }
            return [
                "success" => false,
                "reason"  => "Tax service not working.",
                "data"    => null
            ];
        }
    }

    public function getAverageSalary($data){
        $tax_info = TaxModel::where(['serial_number' => $data['serial_number']])->first();
        return $tax_info->average_salary ?? 0;
    }
}