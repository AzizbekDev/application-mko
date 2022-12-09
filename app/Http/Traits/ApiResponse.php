<?php
namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function response($status, $result = null, $error = null, $extraData = [])
    {
        $json = [
            'status'  => $status,
            'result'  => $result,
            'error'   => $error,
        ];
        if ($extraData) {
            $json = array_merge($json, $extraData);
        }
        return response()->json($json);
    }

    public function responseSuccess($code, $message, $extraData = [])
    {
        $result = [
            'code'      => $code,
            'message'   => $message
        ];
        return (!$extraData) ? $this->response(true, $result) : $this->response(true, $result, null, $extraData);
    }

    public function responseError($code, $message, $extraData = [])
    {
        $error = [
            'code'      => $code,
            'message'   => $message
        ];
        return (!$extraData) ? $this->response(false,null, $error) : $this->response(false, null, $error, $extraData);
    }
}




