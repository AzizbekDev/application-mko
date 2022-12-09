<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\BlockedApplications;
use App\Models\Application;

class ApplicationsController extends Controller
{
    public function index(Request $request, $type)
    {
        $method = get_method_name($type);

        abort_if(Gate::denies($method.'_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        method_exists($this, $method) ? $this->$method($request) : abort(404);
    }

    public function all(Request $request){
        return view('admin.applications.index');
    }

    public function new(Request $request){
        return view('admin.applications.new');
    }
    public function viewed(Request $request){
        return view('admin.applications.viewed');
    }

    public function approved(Request $request){
        return view('admin.applications.approved');
    }

    public function rejected(Request $request){
        return view('admin.applications.rejected');
    }

    public function blocked(Request $request){
        $applications = BlockedApplications::all();
        return view('admin.applications.bocked', compact('applications'));
    }
}
