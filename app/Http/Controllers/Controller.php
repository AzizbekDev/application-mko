<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Traits\ApiResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    protected static $BASE_PATH_APPLICATION_API = "App\Http\Controllers\Api\V1\Application";
    protected static $BASE_PATH_UNIRED_API = "App\Http\Controllers\Api\V1\Unired";

    protected  static function getBasePath($value): string
    {
        switch ($value) {
            case 'application':
                return self::$BASE_PATH_APPLICATION_API;
            case 'unired':
                return self::$BASE_PATH_UNIRED_API;
        }
    }
}
