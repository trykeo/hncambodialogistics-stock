@can('product_movement_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.product-movements.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.productMovement.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.productMovement.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-inLocationProductMovements">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.product') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.remark') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.in_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_in_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_in_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.out_location') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_out_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_out_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.finish_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.productMovement.fields.record_finish_by') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productMovements as $key => $productMovement)
                        <tr data-entry-id="{{ $productMovement->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $productMovement->id ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->product->bar_code ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->remark ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->in_location->code ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->record_in_at ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->record_in_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->out_location->code ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->record_out_at ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->record_out_by->name ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->finish_at ?? '' }}
                            </td>
                            <td>
                                {{ $productMovement->record_finish_by->name ?? '' }}
                            </td>
                            <td>
                                @can('product_movement_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.product-movements.show', $productMovement->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_movement_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.product-movements.edit', $productMovement->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_movement_delete')
                                    <form action="{{ route('admin.product-movements.destroy', $productMovement->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_movement_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-movements.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-inLocationProductMovements:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection