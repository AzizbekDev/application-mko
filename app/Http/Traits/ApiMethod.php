<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

trait ApiMethod
{
    use ApiResponse;
    public function index(Request $request)
    {
        if (isset($request->method)) {
            if(isset($request->params)){
                $method = get_method_name($request->method);
                $request->replace(array_merge($request->params, [
                    'partner_id' => $request->user_id
                ]));
                if(method_exists($this, $method)){
                    $respond = $this->$method($request);
                }else{
                    $respond = $this->responseError('10405', "'method' not found");
                }
            }else{
                $respond = $this->responseError('10407', "'params' is required");
            }
        }else{
            $respond = $this->responseError('10406', "'method' is required");
        }
        return $respond;
    }
}