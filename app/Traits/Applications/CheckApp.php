<?php
namespace App\Traits\Applications;

use Illuminate\Http\Request;
use App\Models\Application;
use Carbon\Carbon;

trait CheckApp{
    public function checkApplication(Request $request){
        // Check application is exists
        if($request->has('serial_number')){
            if(Application::where('serial_number', $request->serial_number)->where('status_id', '8')->exists()){
                return (object)[
                    'status'  => true,
                    'code'    => '10000',
                    'message' => 'Bunday zayafka mavjud!'
                ];
            }
        }
        // Check application form other clients DB of UNIRED

        // Check application is not blocked

        // Check Person is not younger or older
        if($request->has('pin') ){
            $age = Carbon::parse(extract_passport_birth_date($request->pin))->age;
            if(20 > $age || 65 < $age){
                return (object)[
                    'status'  => true,
                    'code'    => '10001',
                    'message' => 'Tug\'ilgan sana, shartlarga mos kelmadi. 20 < '.$age.' < 65'
                ];
            }
        }
    }
}