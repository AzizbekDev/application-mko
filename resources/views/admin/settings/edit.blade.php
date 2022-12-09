@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.settings.title') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.settings.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <form action="{{ route('admin.settings.update', $setting->id ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-forms.setting :setting="$setting" />
                    @if(!empty($setting->value))
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                        </div>
                    @endif
                </form>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.settings.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection