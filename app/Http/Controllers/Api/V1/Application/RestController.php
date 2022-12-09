<?php

namespace App\Http\Controllers\Api\V1\Application;

use App;
use Illuminate\Http\Request;
use App\Http\Traits\ApiMethod;
use App\Http\Controllers\Controller;

class RestController extends Controller
{
    use ApiMethod;

    private $basePathApplicationAPI;

    public function __construct() {
        $this->basePathApplicationAPI = parent::getBasePath('application');
    }

    // Rest Online Application API's
    protected function clientInfo(){
        return App::call($this->basePathApplicationAPI.'\ClientInfoController@clientInfo');
    }

    protected function identifiedClientInfo(){
        return App::call($this->basePathApplicationAPI.'\IdentifiedClientInfoController@identifiedClientInfo');
    }

    protected function cardInfo(){
        return App::call($this->basePathApplicationAPI.'\CardInfoController@cardInfo');
    }

    protected function confirmLimit(){
        return App::call($this->basePathApplicationAPI.'\PaymentController@confirmLimit');
    }

    // Rest Application API's
    protected function appStatus(){
        return App::call($this->basePathApplicationAPI.'\ApplicationController@appStatus');
    }

    protected function appReject(){
        return App::call($this->basePathApplicationAPI.'\ApplicationController@appReject');
    }

    protected function appPaymentStatus(){
        return App::call($this->basePathApplicationAPI.'\ApplicationController@appPaymentStatus');
    }

    protected function getCardInfo(){
        return App::call($this->basePathApplicationAPI.'\ApplicationController@getCardInfo');
    }

    protected function getPersonalInfo(){
        return App::call($this->basePathApplicationAPI.'\ApplicationController@getPersonalInfo');
    }

    protected function updatePersonalInfo(){
        return App::call($this->basePathApplicationAPI.'\ApplicationController@updatePersonalInfo');
    }
}