@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('applications') }}
    <div class="card">
        <div class="card-header">
            Application List Header
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    Application List Body
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