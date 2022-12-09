@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.clients.title_singular') }} {{ trans('global.list') }}
        </div>
        <div class="card-body">
            Clients data
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
    </script>
@endsection