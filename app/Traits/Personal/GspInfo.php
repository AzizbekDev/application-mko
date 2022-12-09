<?php
namespace App\Traits\Personal;

use App\Models\PersonalInfo;
use App\Traits\Personal\CheckPerson;
use App\Services\Conveyor\IdentifyPerson;

trait GspInfo{
    public function getGspInfo($data):array
    {
        // some logic
        return array_merge(
            [
                'service' => 'GSP',
                'data'    => $data
            ]);
    }

    public function updateGspInfo($data):array
    {
        // some logic
    }
}