@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('application_blocked') }}
    <div class="card">
        <div class="card-header">
            Application Blocked Header
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    Application Blocked Body
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {

        });
    </script>
@endsection