@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('application_new') }}
    <div class="card">
        <div class="card-header">
            Application Show Header
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    Application Show Body
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