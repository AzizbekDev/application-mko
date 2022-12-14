<?php
namespace App\Traits\Personal;

use App\Models\MyIdInfo as MyIdModal;
use App\Services\MyIdService;

trait MyIdInfo{

    public function identifyPerson($appInfo): bool
    {
        $responseJobId   = (new MyIdService())->getJobId($appInfo['serial_number'], $appInfo['birth_date'], $appInfo['person_photo']);
        sleep(2);
        if($responseJobId && array_key_exists('job_id', $responseJobId)){
            $job_id = $responseJobId['job_id'];
            $modal  = MyIdModal::updateOrCreate([
               'pass_data'  => $appInfo['serial_number'],
               'pinfl'      => $appInfo['pin']
            ],['job_id'     => $job_id]);
            $responsePersonInfo = (new MyIdService())->getPassportInfo($job_id);
            if($responsePersonInfo){
                return $modal->saveProfile($responsePersonInfo) ? true : false;
            }
        }
        return false;
    }
}