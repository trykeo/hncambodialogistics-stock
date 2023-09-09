@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Update Stock In
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.stock-ins.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="bar_code">{{ $product->is_group ? 'Group Code' : trans('cruds.product.fields.bar_code') }}</label>
                <input class="form-control {{ $errors->has('bar_code') ? 'is-invalid' : '' }}" type="text" name="bar_code" id="bar_code" 
                    value="{{ old('bar_code', $product->bar_code) }}" autofocus required>
                @if($errors->has('bar_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bar_code') }}
                    </div>
                @endif
            </div>
            
            @if ($product->is_group)
            <div class="form-group">
                <label class="required" for="group_products">Product in group</label>
                <textarea required autofocus 
                    class="form-control {{ $errors->has('group_products') ? 'is-invalid' : '' }}" 
                    id="group_products" name="group_products" rows="12"
                    >{{ old('group_products', $product->group_products) }}</textarea>
            </div>
            @else
            <div class="form-group">
                <label for="group">{{ trans('cruds.product.fields.group') }}</label>
                <input class="form-control {{ $errors->has('group') ? 'is-invalid' : '' }}" type="text" name="group" id="group" 
                    value="{{ old('group', $product->group) }}" autofocus required>
                @if($errors->has('group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('group') }}
                    </div>
                @endif
            </div>
            @endif

            {{-- <div class="form-group">
                <label for="remark">{{ trans('cruds.product.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark" id="remark">{{ old('remark', $product->remark) }}</textarea>
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