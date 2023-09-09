@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.product.title_singular') }} Stock Complete
    </div>

    <div class="card-body">
        <form method="POST" id="inputForm" action="{{ route("admin.stock-completes.store") }}"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="finish_status">Finish status</label>
                <select class="form-control select2 {{ $errors->has('finish_status') ? 'is-invalid' : '' }}" name="finish_status" id="finish_status" required>
                    @foreach(App\Models\ProductMovement::FINISH_STATUS as $value => $finish_status)
                        <option value="{{ $value }}" {{ in_array($value, old('finish_status', [])) ? 'selected' : '' }}>{{ $finish_status }}</option>
                    @endforeach
                </select>
                @if($errors->has('finish_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finish_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="products">{{ trans('cruds.product.fields.bar_code') }}</label>
                <table id="product-table"
                    class=" table table-bordered table-striped table-hover datatable datatable-Location">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.product.fields.bar_code') }}
                            </th>
                            <th>
                                Current Stock Location
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.group') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.created_at') }}
                            </th>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach($user_locations as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    <option value="group">Group Product</option>
                                    <option value="product">Product</option>
                                </select>
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        @if ($product->latestMovement != null && 
                                $product->latestMovement->in_location != null && 
                                in_array($product->latestMovement->in_location->full_name, $user_locations))
                            <tr data-entry-id="{{ $product->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $product->bar_code ?? '' }}
                                </td>
                                <td>
                                    {{ $product->latestMovement->in_location->full_name ?? '' }}
                                </td>
                                <td>
                                    {{ $product->is_group ? 'group' : 'product' }}
                                </td>
                                <td>
                                    {{ $product->group ?? '' }}
                                </td>
                                <td>
                                    {{ $product->created_at ?? '' }}
                                </td>
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <input type="hidden" id="products" value="" name="products">

            {{-- <div class="form-group">
                <label for="remark">{{ trans('cruds.product.fields.remark') }}</label>
                <textarea class="form-control {{ $errors->has('remark') ? 'is-invalid' : '' }}" name="remark"
                    id="remark">{{ old('remark') }}</textarea>
                @if($errors->has('remark'))
                <div class="invalid-feedback">
                    {{ $errors->first('remark') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.remark_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <a class="btn btn-danger" type="submit" onclick="submitForm()" href="#">
                    {{ trans('global.save') }}
                </a>
            </div>
        </form>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    function submitForm() {
        var table = $('#product-table').DataTable();
        var ids = $.map(table.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
        });
        
        if (ids.length === 0) {
            alert('{{ trans('global.datatables.zero_selected') }}')

            return
        }

        document.getElementById('products').value = ids;
        document.getElementById("inputForm").submit();
    }
</script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons).slice(0, 2); // only [selectAll, selectNone]

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 3, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Location:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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