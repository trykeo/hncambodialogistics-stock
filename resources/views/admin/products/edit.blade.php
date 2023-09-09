@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bar_code">{{ trans('cruds.product.fields.bar_code') }}</label>
                <input class="form-control {{ $errors->has('bar_code') ? 'is-invalid' : '' }}" type="text" name="bar_code" id="bar_code" value="{{ old('bar_code', $product->bar_code) }}" required>
                @if($errors->has('bar_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bar_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.bar_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="group">{{ trans('cruds.product.fields.group') }}</label>
                <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" value="{{ old('group', $product->group) }}">
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.group_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deliver_at">{{ trans('cruds.product.fields.deliver_at') }}</label>
                <input class="form-control datetime {{ $errors->has('deliver_at') ? 'is-invalid' : '' }}" type="text" name="deliver_at" id="deliver_at" value="{{ old('deliver_at', $product->deliver_at) }}">
                @if($errors->has('deliver_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deliver_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.deliver_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remark">{{ trans('cruds.product.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $product->remark) }}</textarea>
                @if($errors->has('remark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.remark_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_group') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_group" value="0">
                    <input class="form-check-input" type="checkbox" name="is_group" id="is_group" value="1" {{ $product->is_group || old('is_group', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_group">{{ trans('cruds.product.fields.is_group') }}</label>
                </div>
                @if($errors->has('is_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.is_group_helper') }}</span>
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