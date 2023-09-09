@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.product.title_singular') }} Stock In
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.th-stock-ins.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="in_location_id">{{ trans('cruds.productMovement.fields.in_location') }}</label>
                <select class="form-control select2 {{ $errors->has('in_location') ? 'is-invalid' : '' }}" name="in_location_id" id="in_location_id" required>
                    @foreach($in_locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('in_location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('in_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('in_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.in_location_helper') }}</span>
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

            {{-- <div class="form-group">
                <label for="remark">{{ trans('cruds.product.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark') }}</textarea>
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.remark_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection