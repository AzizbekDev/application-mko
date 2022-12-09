<?php
namespace App\Http\Controllers\Api\V1\Card;

use App\Models\Terminal;
use App\Services\Card\UnisoftGate;
use App\Traits\Holds\RestoreCardPayment;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnisoftController extends Controller
{
    use ApiMethod, RestoreCardPayment;

    private $unisoft;

    public function __construct(UnisoftGate $unisoftGate)
    {
        $this->unisoft = $unisoftGate;
    }

    protected function login(Request $request){
        $v = Validator::make($request->all(), [
            'type' => 'required|in:humo,unired',
        ]);
        if ($v->fails()) return $this->responseError('30410',$v->errors()->all());
        $result = $this->unisoft->login($request->type);
        dd($result);
    }

    protected function cardRegister(Request $request){
        $v = Validator::make($request->all(), [
            'card_number' => 'required|size:16',
            'expire'      => 'required|size:4'
        ]);
        if ($v->fails()) return $this->responseError('30410',$v->errors()->all());
        // RegisterCard method from Unisoft Gateway
        $data = $this->unisoft->card_register($request->card_number, $request->expire);
        dd($data);
    }

    protected function cardInfo(Request $request){
        $v = Validator::make($request->all(), [
            'card_number' => 'required|size:16'
        ]);
        if ($v->fails()) return $this->responseError('30410',$v->errors()->all());
        $data = $this->unisoft->card_info($request->card_number);
        dd($request->all());
    }

    protected function holdCreate(Request $request){
        $v = Validator::make($request->all(), [
            'card_number' => 'required|size:16',
            'expire'      => 'required|size:4',
            'amount'      => 'required'
        ]);
        if ($v->fails()) return $this->responseError('30410',$v->errors()->all());
        return $this->hold_create($request);
    }

    protected function terminalAdd(Request $request){
        $v = Validator::make($request->all(), [
            'merchant_type' => 'required|in:humo,unired',
            'merchant'      => 'required|unique:terminals',
            'terminal'      => 'required|unique:terminals',
            'type'          => 'required',
            'purpose'       => 'required',
            'port'          => 'required_if:merchant_type,unired',
            'point_code'    => 'required_if:merchant_type,humo',
            'originator'    => 'required_if:merchant_type,humo',
            'center_id'     => 'required_if:merchant_type,humo|string'
        ]);
        if ($v->fails()) return $this->responseError('40410',$v->errors()->all());
        $data = $this->unisoft->terminal_add($request->all(), $request->merchant_type);
        dd($data);
         $info = Terminal::create($request->all());
        dd($data);

        dd($request);
    }

    protected function terminalRemove(Request $request){
        $v = Validator::make($request->all(), [
            'merchant'   => 'required',
            'terminal'   => 'required'
        ]);
        if ($v->fails()) return $this->responseError('40410',$v->errors()->all());
        $data = $this->unisoft->terminal_remove($request->all());
        dd($data);
    }

    protected function terminalCheck(Request $request){
        $v = Validator::make($request->all(), [
            'merchant'   => 'required',
            'terminal'   => 'required'
        ]);
        if ($v->fails()) return $this->responseError('40410',$v->errors()->all());
        $data = $this->unisoft->terminal_check($request->all());
        dd($data);
    }
}