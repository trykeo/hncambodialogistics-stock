@extends('layouts.admin')
@section('content')
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ProductMovement">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    {{-- <th>
                        {{ trans('cruds.productMovement.fields.id') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.productMovement.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.productMovement.fields.remark') }}
                    </th>
                    <th>
                        Stock in location
                        {{-- {{ trans('cruds.productMovement.fields.in_location') }} --}}
                    </th>
                    <th>
                        {{ trans('cruds.productMovement.fields.record_in_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.productMovement.fields.record_in_by') }}
                    </th>
                    <th>
                        Destination location
                        {{-- {{ trans('cruds.productMovement.fields.out_location') }} --}}
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
                <tr>
                    <td>
                    </td>
                    {{-- <td></td> --}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    {{-- <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($products as $key => $item)
                                <option value="{{ $item->bar_code }}">{{ $item->bar_code }}</option>
                            @endforeach
                        </select>
                    </td> --}}
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($locations as $key => $item)
                                <option value="{{ $item->code }}">{{ $item->code }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($locations as $key => $item)
                                <option value="{{ $item->code }}">{{ $item->code }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('product_movement_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.product-movements.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.product-movements.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
// { data: 'id', name: 'id' },
{ data: 'product_bar_code', name: 'product.bar_code' },
{ data: 'remark', name: 'remark' },
{ data: 'in_location_code', name: 'in_location.code' },
{ data: 'record_in_at', name: 'record_in_at' },
{ data: 'record_in_by_name', name: 'record_in_by.name' },
{ data: 'out_location_code', name: 'out_location.code' },
{ data: 'record_out_at', name: 'record_out_at' },
{ data: 'record_out_by_name', name: 'record_out_by.name' },
{ data: 'finish_at', name: 'finish_at' },
{ data: 'record_finish_by_name', name: 'record_finish_by.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ProductMovement').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection