@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Product Grouping
    </div>

    <div class="card-body">
        <form method="POST" id="inputForm" action="{{ route("admin.kh-stock-ins.storeGrouping") }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="group">Group Code</label>
                <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" value="{{ old('group', '') }}" autofocus required>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="bar_code">{{ trans('cruds.product.fields.bar_code') }}</label>
                <textarea required autofocus 
                    class="form-control {{ $errors->has('bar_code') ? 'is-invalid' : '' }}" 
                    id="bar_code" name="bar_code" rows="12"
                    >{{ old('bar_code') }}</textarea>
                @if($errors->has('bar_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bar_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.bar_code_helper') }}</span>
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