<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Models\BlockedApplications;
use App\Models\Application;
use App\Models\Client;
use App\Traits\Personal\KatmInfo;

class ApplicationsController extends Controller
{
    use KatmInfo;
    public function index(Request $request)
    {
//        abort_if(Gate::denies('all_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $applications = Client::with([
            'application',
            'application.applicationInfo',
            'application.partnerInfo'])->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function new(Request $request){
        abort_if(Gate::denies('new_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Client::with([
            'application',
            'application.applicationInfo',
            'application.partnerInfo'])->statusApp(0)->get();
        return view('admin.applications.new', compact('applications'));
    }
    public function viewed(Request $request){
        abort_if(Gate::denies('viewed_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Client::statusApp(1)->get();

        return view('admin.applications.viewed', compact('applications'));
    }

    public function approved(Request $request){

        abort_if(Gate::denies('approved_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Client::statusApp(2)->get();

        return view('admin.applications.approved', compact('applications'));
    }

    public function rejected(Request $request){
        abort_if(Gate::denies('rejected_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = Client::statusApp(3)->get();

        return view('admin.applications.rejected', compact('applications'));
    }

    public function blocked(Request $request){
        abort_if(Gate::denies('blocked_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applications = BlockedApplications::all();

        return view('admin.applications.blocked', compact('applications'));
    }
}
