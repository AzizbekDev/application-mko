<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        return view('admin.clients.index');
    }

    public function show(Request $request, Client $client){
        return view('admin.clients.show', compact('client'));
    }
}
