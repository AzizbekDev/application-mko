<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use App\Models\Client;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.pages.search');
    }

    public function search(Request $request){
        if($request->filled('fio')){
            $clients = Client::with([
                'application',
                'application.applicationInfo',
                'application.partnerInfo'])
                ->whereHas('application.applicationInfo',function ($query) use ($request) {
                    return $query->where('fio', 'LIKE', "%{$request->fio}%");
                })
                ->where('status_id', '<=', 3)
                ->orderBy('id','DESC')
                ->get();
        }elseif($request->filled('phone')){
            $clients = Client::with([
                'application',
                'application.applicationInfo',
                'application.partnerInfo'])
                ->whereHas('application',function ($query) use ($request) {
                    return $query->where('phone', 'LIKE', "%{$request->phone}%");
                })
                ->where('status_id', '<=', 3)
                ->orderBy('id','DESC')
                ->get();
        }elseif($request->filled('card_number')){
            $clients = Client::with([
                'application',
                'application.applicationInfo',
                'application.partnerInfo'])
                ->whereHas('application',function ($query) use ($request) {
                    return $query->where('card_mask', 'LIKE', "%{$request->card_number}");
                })->where('status_id', '<=', 3)
                ->orderBy('id','DESC')
                ->get();
        }
        return view('admin.clients.index', compact('clients'));
    }
}