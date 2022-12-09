@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('application_viewed') }}
    <div class="card">
        <div class="card-header">
            Application Viewed Header
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    Application Viewed Body
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