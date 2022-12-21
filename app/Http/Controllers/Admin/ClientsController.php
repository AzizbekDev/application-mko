<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\TaxInfo;
use App\Models\MyIdInfo;
use App\Models\SalaryCard;
use App\Services\Wallet\ClientCreate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        // select client status_id = 3 (WalletCreated)
        $clients = Client::where('status_app_id', 3)->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function show(Request $request, Client $client){
        $application = $client->load([
                'application',
                'application.applicationInfo',
                'application.partnerInfo'
        ])->application;
        $wallet           = $client->wallet;
        $application_info = $application->applicationInfo;
        $salary_cards     = $application->salaryCards;
//        $tax_scoring      =
        return view('admin.clients.show', compact(
            'client',
            'application',
            'application_info',
            'salary_cards',
            'wallet'));
    }

    public function createWallet(Request $request){
        $client = Client::find($request->client_id);
        if(empty($client->wallet)){
            $passport = MyIdInfo::wherePassData($client->application->serial_number)->first();
            $data = [
                'application_id' => $client->application->key_app,
                'client_code'    => $client->application->serial_number,
                'pnfl'           => $client->application->pin,
                'passport'       => $client->application->serial_number,
                'phone'          => '+'.$client->application->phone,
                'limit'          => 10000000,
                'date_expiry'    => Carbon::now()->addYear()->startOfMonth()->format('Y-m-d'),
                'first_name'     => json_decode($passport->profile, 'true')['common_data']['first_name'],
                'last_name'      => json_decode($passport->profile, 'true')['common_data']['last_name'],
                'middle_name'    => json_decode($passport->profile, 'true')['common_data']['middle_name'],
            ];
            $response = (new ClientCreate())->apply($data);
            if($response && $response['status']){
                $client->wallet()->create([
                    'owner' => $response['result']['owner'],
                    'card_number' => $response['result']['number'],
                    'card_expire' => $response['result']['expire'],
                    'phone' => $response['result']['phone'],
                    'token' => $response['result']['token'],
                    'balance' => $response['result']['balance'],
                    'status' => $response['result']['status'],
                ]);
            }
        }
        return response()->json([
            'status' => $client->wallet ? true : false,
            'info'   => $client->wallet,
            'message'=> 'Success'
        ]);

    }
}
