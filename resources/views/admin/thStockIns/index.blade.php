@extends('layouts.admin')
@section('content')
@can('product_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.th-stock-ins.create') }}">
            {{-- <i class="fa-fw fas fa-boxes mr-2"></i> --}}
            <i class="fa-fw fas fa-archive mr-2"></i>
            TH Stock In
        </a>

        <a class="btn btn-info" href="{{ route('admin.th-stock-ins.grouping') }}">
            {{-- <i class="fa-fw fas fa-archive mr-2"></i> --}}
            <i class="fa-fw fas fa-boxes mr-2"></i>
            TH Group Stock
        </a>
    </div>
</div>
@endcan

@if (isset($messages) && $messages != null && count($messages) > 0)
@foreach ($messages as $type => $msgs)
@if (count($msgs) > 0)
<div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">
    <strong>Messages</strong>
    <hr />
    @foreach ($msgs as $msg)
    <p>{{$msg}}</p>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@endforeach
@endif

<div class="card">
    <div class="card-header">
        {{ trans('cruds.stockIn.title') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.product.fields.bar_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.group') }}
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Stock in at
                    </th>
                    <th>
                        Stock in Location
                    </th>
                    {{-- <th>
                        {{ trans('cruds.product.fields.remark') }}
                    </th> --}}
                    {{-- <th>
                        {{ trans('cruds.product.fields.created_at') }}
                    </th> --}}
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        {{-- <input class="search" type="text" placeholder="{{ trans('global.search') }}"> --}}
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($groups as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            <option value="Group">Group</option>
                            <option value="Product">Product</option>
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($locations as $location)
                            <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </td>
                    {{-- <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td> --}}
                    {{-- <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td> --}}
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
@can('stock_in_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.th-stock-ins.massDestroy') }}",
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
    ajax: "{{ route('admin.th-stock-ins.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'bar_code', name: 'bar_code' },
{ data: 'group', name: 'group' },
// { data: 'is_group', name: 'is_group' },
{data: 'type', name: 'type'},
{ data: 'stock_in_at', name: 'stock_in_at' },
{ data: 'stock_in_location', name: 'stock_in_location' },
// { data: 'deliver_at', name: 'deliver_at' },
// { data: 'remark', name: 'remark' },
// { data: 'created_at', name: 'created_at' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 4, 'desc' ]], // stock_in_at
    pageLength: 100,
  };
  let table = $('.datatable-Product').DataTable(dtOverrideGlobals);
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