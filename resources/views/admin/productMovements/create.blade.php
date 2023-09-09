@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.productMovement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.product-movements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="product_id">{{ trans('cruds.productMovement.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id" required>
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.productMovement.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark') }}</textarea>
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="in_location_id">Stock in location</label>
                    {{-- {{ trans('cruds.productMovement.fields.in_location') }}</label> --}}
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
                <label class="required" for="record_in_at">{{ trans('cruds.productMovement.fields.record_in_at') }}</label>
                <input class="form-control datetime {{ $errors->has('record_in_at') ? 'is-invalid' : '' }}" type="text" name="record_in_at" id="record_in_at" value="{{ old('record_in_at') }}" required>
                @if($errors->has('record_in_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record_in_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.record_in_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="record_in_by_id">{{ trans('cruds.productMovement.fields.record_in_by') }}</label>
                <select class="form-control select2 {{ $errors->has('record_in_by') ? 'is-invalid' : '' }}" name="record_in_by_id" id="record_in_by_id" required>
                    @foreach($record_in_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('record_in_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('record_in_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record_in_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.record_in_by_helper') }}</span>
            </div>
            <div class="form-group">
                {{-- {{ trans('cruds.productMovement.fields.out_location') }} --}}
                <label for="out_location_id">Destination location</label>
                <select class="form-control select2 {{ $errors->has('out_location') ? 'is-invalid' : '' }}" name="out_location_id" id="out_location_id">
                    @foreach($out_locations as $id => $entry)
                        <option value="{{ $id }}" {{ old('out_location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('out_location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('out_location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.out_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="record_out_at">{{ trans('cruds.productMovement.fields.record_out_at') }}</label>
                <input class="form-control datetime {{ $errors->has('record_out_at') ? 'is-invalid' : '' }}" type="text" name="record_out_at" id="record_out_at" value="{{ old('record_out_at') }}">
                @if($errors->has('record_out_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record_out_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.record_out_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="record_out_by_id">{{ trans('cruds.productMovement.fields.record_out_by') }}</label>
                <select class="form-control select2 {{ $errors->has('record_out_by') ? 'is-invalid' : '' }}" name="record_out_by_id" id="record_out_by_id">
                    @foreach($record_out_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('record_out_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('record_out_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record_out_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.record_out_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="finish_at">{{ trans('cruds.productMovement.fields.finish_at') }}</label>
                <input class="form-control datetime {{ $errors->has('finish_at') ? 'is-invalid' : '' }}" type="text" name="finish_at" id="finish_at" value="{{ old('finish_at') }}">
                @if($errors->has('finish_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finish_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.finish_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="record_finish_by_id">{{ trans('cruds.productMovement.fields.record_finish_by') }}</label>
                <select class="form-control select2 {{ $errors->has('record_finish_by') ? 'is-invalid' : '' }}" name="record_finish_by_id" id="record_finish_by_id">
                    @foreach($record_finish_bies as $id => $entry)
                        <option value="{{ $id }}" {{ old('record_finish_by_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('record_finish_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('record_finish_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.productMovement.fields.record_finish_by_helper') }}</span>
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