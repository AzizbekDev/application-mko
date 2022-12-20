<?php
namespace App\Traits\Personal;

use App\Models\TaxInfo as TaxModel;
use App\Models\TaxDetail;
use App\Services\TaxService;
use Illuminate\Support\Collection;
use Carbon\Carbon;
trait TaxInfo{
    static $statusSuccess  = 1;
    static $messageSuccess = 'Success';
    public function getTaxSalaryInfo($data){
        $query = TaxModel::where($data)->first();
        if($query && $query->status_id == 1){
            return [
                "success" => true,
                "reason"  => null,
                "average_salary" => $query->average_salary,
                "data"    => $query->details->toArray()
            ];
        }
        $response = (new TaxService())->getSalaryInfo($data);
        if($response && array_key_exists('success', $response)){
            if($response['success'] && !empty($response['data'])){
                $taxModel = TaxModel::updateOrCreate([
                    'tin'           => $response['data'][0]['tin'],
                    'pinfl'         => $response['data'][0]['pinfl'],
                    'serial_number' => $response['data'][0]['series_passport'].str_pad($response['data'][0]['number_passport'], 7, '0', STR_PAD_LEFT),
                ],[
                    'name'          => $response['data'][0]['name'],
                    'ns10_code'     => $response['data'][0]['ns10_code'],
                    'ns11_code'     => $response['data'][0]['ns11_code'],
                    'last_year'     => (int)Carbon::now()->format('Y'),
                    'last_period'   => (int)Carbon::now()->format('m'),
                    'status_id'     => self::$statusSuccess,
                    'status_message'=> self::$messageSuccess,
                ]);
                $details = new Collection();
                foreach ($response['data'] as $data){
                    $details->push([
                        "company_name"   => $data['company_name'],
                        "company_tin"    => $data['company_tin'],
                        "year"           => $data['year'],
                        "period"         => $data['period'],
                        "salary"         => intval($data['salary']),
                        "salary_tax_sum" => intval($data['salary_tax_sum']),
                        "inps_sum"       => intval($data['inps_sum']),
                        "prop_income"    => intval($data['prop_income']),
                        "other_income"   => intval($data['other_income']),
                    ]);
                }
                $average_salary = $details->groupBy('company_tin')->map(function ($company){
                   return $company->slice(-6, 6)->avg('salary');
                })->avg();
                $taxModel->update([
                    'average_salary' => intval($average_salary)
                ]);
                $taxModel->details()->delete();
                $taxModel->details()->createMany($details->toArray());
            }
            return array_merge($response, ['average_salary' => $average_salary]);
        }
        return [
            "success" => false,
            "reason"  => "Tax service not working...",
            "data"    => null
        ];
    }

    public function getAverageSalary($data){
        $tax_info = TaxModel::where(['serial_number' => $data['serial_number']])->first();
        return $tax_info->average_salary ?? 0;
    }
}