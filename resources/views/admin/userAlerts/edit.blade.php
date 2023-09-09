@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userAlert.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-alerts.update", [$userAlert->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="alter_title">{{ trans('cruds.userAlert.fields.alter_title') }}</label>
                <input class="form-control {{ $errors->has('alter_title') ? 'is-invalid' : '' }}" type="text" name="alter_title" id="alter_title" value="{{ old('alter_title', $userAlert->alter_title) }}" required>
                @if($errors->has('alter_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alter_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.alter_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="view_at">{{ trans('cruds.userAlert.fields.view_at') }}</label>
                <input class="form-control datetime {{ $errors->has('view_at') ? 'is-invalid' : '' }}" type="text" name="view_at" id="view_at" value="{{ old('view_at', $userAlert->view_at) }}">
                @if($errors->has('view_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('view_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userAlert.fields.view_at_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection