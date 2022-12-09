@extends('layouts.admin')
@section('content')
{{ Breadcrumbs::render('reports') }}
<div class="card">
    <div class="card-header">
        Reports header
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-8">
                Reports Body
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