@extends('layouts.order-report')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <div class="dropdown">
            <?php $report_options = [
                    'today' => 'Today', 
                    'this_month' => 'This month', 
                    'this_year' => 'This year'
                ]; ?>

            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
              Report by {{ $report_options[$report_by] }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($report_options as $key => $option)
                    <a class="dropdown-item" href="{{ route('admin.order-reports.index', ['report_by' => $key]) }}">{{ $option }}</a>
                @endforeach
            </div>
          </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.orderReport.title_singular') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Product">
                <thead>
                    <tr>
                        {{-- <th width="10">

                        </th> --}}
                        <th>
                            Record Type
                        </th>
                        <th>
                            Record Date
                        </th>
                        <th>
                            Location
                        </th>
                        <th>
                            Record By
                        </th>

                        <th>
                            {{ trans('cruds.product.fields.bar_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.group') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.product.fields.remark') }}
                        </th> --}}
                        <th>
                            Type
                        </th>
                    </tr>
                    <tr>
                        {{-- <td>
                        </td> --}}
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="stock-in">Stock In</option>
                                <option value="stock-out">Stock Out</option>
                                @foreach (App\Models\ProductMovement::FINISH_STATUS as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                                {{-- <option value="stock-complete">Stock Complete</option> --}}
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        {{-- <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td> --}}
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                <option value="group">Group Product</option>
                                <option value="product">Product</option>
                            </select>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    @if ($record->record_in_at != null)
                        <tr>
                            {{-- <td></td> --}}
                            <td>stock-in</td>
                            <td>{{ $record->record_in_at ?? '' }}</td>
                            <td>{{ $record->in_location->full_name ?? '' }}</td>
                            <td>{{ $record->record_in_by->name ?? '' }}</td>

                            <td>{{ $record->product->bar_code ?? '' }}</td>
                            <td>{{ $record->product->group ?? '' }}</td>
                            {{-- <td>{{ $record->product->remark ?? '' }}</td> --}}
                            <td>
                                @if ($record->product->is_group)
                                <span class="badge badge-info">Group</span>
                                @else
                                <span class="badge badge-success">Product</span>
                                @endif
                            </td>
                        </tr>
                    @endif

                    @if ($record->record_out_at != null)
                        <tr>
                            {{-- <td></td> --}}
                            <td>stock-out</td>
                            <td>{{ $record->record_out_at ?? '' }}</td>
                            <td>{{ $record->out_location->full_name ?? '' }}</td>
                            <td>{{ $record->record_out_by->name ?? '' }}</td>

                            <td>{{ $record->product->bar_code ?? '' }}</td>
                            <td>{{ $record->product->group ?? '' }}</td>
                            {{-- <td>{{ $record->product->remark ?? '' }}</td> --}}
                            <td>
                                @if ($record->product->is_group)
                                <span class="badge badge-info">Group</span>
                                @else
                                <span class="badge badge-success">Product</span>
                                @endif
                            </td>
                        </tr>
                    @elseif ($record->finish_at != null)
                    <tr>
                        {{-- <td></td> --}}
                        {{-- <td>stock-complete</td> --}}
                        <td>
                            {{ App\Models\ProductMovement::FINISH_STATUS[$record->finish_status] ?? '' }}
                        </td>
                        <td>{{ $record->finish_at ?? '' }}</td>
                        <td>{{ $record->in_location->full_name ?? '' }}</td>
                        <td>{{ $record->record_finish_by->name ?? '' }}</td>

                        <td>{{ $record->product->bar_code ?? '' }}</td>
                        <td>{{ $record->product->group ?? '' }}</td>
                        {{-- <td>{{ $record->product->remark ?? '' }}</td> --}}
                        <td>
                            @if ($record->product->is_group)
                            <span class="badge badge-info">Group</span>
                            @else
                            <span class="badge badge-success">Product</span>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
})

</script>
@endsection