<?php
namespace App\Traits\Applications;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\BlockedApplications;
use Carbon\Carbon;

trait CheckApp{
    public function checkApplication(Request $request){
        static $result = [];
        // Check application is exists
        if($request->has('serial_number')){
            if(Application::where('serial_number', $request->serial_number)->where('status_id', 11)->exists()){
                $result = [
                    'code'    => '10000',
                    'message' => 'Bunday zayafka mavjud!'
                ];
            }
        }
        // Check application is not blocked
        if($request->has('serial_number')){
            $blocked = BlockedApplications::where('serial_number', $request->serial_number)->exists();
            if($blocked){
                $result = [
                    'code'    => '10003',
                    'message' => 'Bu Ariza blocklangan!'
                ];
            }
        }
        // Check Person is not younger or older
        if($request->has('pin')){
            $age = Carbon::parse(extract_passport_birth_date($request->pin))->age;
            if(20 > $age || 65 < $age){
                $result = [
                    'code'    => '10001',
                    'message' => 'Tug\'ilgan sana, shartlarga mos kelmadi. 20 < '.$age.' < 65'
                ];
            }
        }
        return  $result;
    }
}