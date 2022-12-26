<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\TaxInfo;
use App\Models\MyIdInfo;
use App\Services\Unired\UniredService;
use App\Services\Wallet\ClientCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ClientsController extends Controller
{
    public function index(){
        // select client status_id = 3 (WalletCreated)
        $clients = Client::with([
            'application',
            'application.applicationInfo',
            'application.partnerInfo'])->statusApp(2)->status(3)->get();
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
        $tax_info         = $application->tax;
        $asoki_client     = $application->asokiClient;
        return view('admin.clients.show', compact(
            'client',
            'application',
            'application_info',
            'wallet',
            'salary_cards',
            'tax_info',
            'asoki_client'));
    }

    public function reject(Request $request){
        $client = Client::find($request->client_id);
        $client->update([
            'status_app_id'  => 3,
            'status_id'      => 4,
            'status_message' => 'Rejected'
        ]);
        $client->application->update([
            'serial_number' => '111111111',
            'status_id'     => '12',
            'status_message'=> 'Client Rejected'
        ]);
        Session::flash('success', 'Application rejected');
        return response()->json([
            'status' => true,
            'message'=> 'Application rejected',
        ]);
    }

    public function statusChange(Request $request){
        $client    = Client::find($request->client_id);
        $status_app_id = $request->status_id;
        if($status_app_id == 2){
            if($client->status_id == 1 || $client->status_id == 2){
                $client->update([
                    'status_app_id' => $status_app_id,
                    'status_id'     => 3,
                    'status_message'=> 'Success Client'
                ]);
                Session::flash('success', 'Client Status Updated');
            }elseif($client->status_id == 0){
                Session::flash('error', 'Need to open Client Wallet first.');
            }
        }elseif ($status_app_id == 1 && $client->status_id == 0){
            $client->update([
                'status_app_id' => $status_app_id
            ]);
            Session::flash('success', 'Client Status Updated');
        }else{
            Session::flash('error', 'Action didn\'t allowed.');
        }
        return back();
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
                'limit'          => $client->client_limit ?? 20000000,
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
                if($response['result']['balance'] > 0){
                    $client->update([
                        'status_id'      => 2,
                        'status_message' => 'Limit opened'
                    ]);
                }
                $data = [
                    'key'  => $client->application->key_app,
                    'card' => $response['result']
                ];
                $push = (new UniredService())->send_wallet_push($data);
                Session::flash('success', 'Wallet Created');
                return response()->json([
                    'status' => $client->wallet ? true : false,
                    'info'   => $client->wallet,
                    'push'   => $push,
                    'message'=> 'Success',
                ]);
            }else{
                Session::flash('error', 'Wallet opening error.');
                return response()->json([
                    'status' => false,
                    'info'   => $client->wallet,
                    'message'=> 'Error',
                ]);
            }
        }
        Session::flash('info', 'Wallet opened already.');
        return response()->json([
            'status' => $client->wallet ? true : false,
            'info'   => $client->wallet,
            'message'=> 'Success',
        ]);

    }


}
