@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.productMovement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-movements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.id') }}
                        </th>
                        <td>
                            {{ $productMovement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.product') }}
                        </th>
                        <td>
                            {{ $productMovement->product->bar_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.remark') }}
                        </th>
                        <td>
                            {{ $productMovement->remark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.in_location') }}
                        </th>
                        <td>
                            {{ $productMovement->in_location->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_in_at') }}
                        </th>
                        <td>
                            {{ $productMovement->record_in_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_in_by') }}
                        </th>
                        <td>
                            {{ $productMovement->record_in_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.out_location') }}
                        </th>
                        <td>
                            {{ $productMovement->out_location->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_out_at') }}
                        </th>
                        <td>
                            {{ $productMovement->record_out_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_out_by') }}
                        </th>
                        <td>
                            {{ $productMovement->record_out_by->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.finish_at') }}
                        </th>
                        <td>
                            {{ $productMovement->finish_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_finish_by') }}
                        </th>
                        <td>
                            {{ $productMovement->record_finish_by->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.product-movements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection