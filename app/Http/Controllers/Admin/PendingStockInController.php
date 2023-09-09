<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
// use App\Http\Requests\StoreStockInRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Location;
use App\Models\ProductMovement;
use Yajra\DataTables\Facades\DataTables;

class PendingStockInController extends Controller
{
    // massStockIn
    public function index(Request $request)
    {
        abort_if(Gate::denies('stock_in_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_locations = Location::get();
        
        if (!auth()->user()->is_admin)
        {
            $user_locations = auth()->user()->locations;
        }
        
        $pending_in_stock_products = ProductMovement::whereIn('out_location_id', $user_locations->pluck('id'))
                                ->whereNull('finish_at')
                                ->pluck('product_id');

        if ($request->ajax()) {
            $query = Product::query()->select(sprintf('%s.*', (new Product)->table));

            // new filter for stock-in record
            $query = $query->with('latestMovement')->whereIn('id', $pending_in_stock_products)->get();

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'stock_in_show';
                $editGate      = '';
                $deleteGate    = '';
                $crudRoutePart = 'pending-stock-ins';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('bar_code', function ($row) {
                return $row->bar_code ? $row->bar_code : '';
            });
            $table->editColumn('group', function ($row) {
                return $row->group ? $row->group : '';
            });
            $table->editColumn('stock_out_at', function ($row) {
                if ($row->latestMovement != null && $row->latestMovement->record_out_at != null)
                {
                    return $row->latestMovement->record_out_at;
                }

                return '';
            });
            $table->editColumn('stock_out_location', function ($row) {
                if ($row->latestMovement != null && $row->latestMovement->out_location_id != null)
                {
                    return $row->latestMovement->out_location->full_name;
                }

                return '';
            });
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });
            $table->editColumn('type', function ($row) {
                if ($row->is_group)
                {
                    return '<span class="badge badge-info">Group</span>';
                }

                return '<span class="badge badge-success">Product</span>';
            });
            // $table->editColumn('is_group', function ($row) {
            //     return '<input type="checkbox" disabled ' . ($row->is_group ? 'checked' : null) . '>';
            // });

            $table->rawColumns(['actions', 'placeholder', 'type']);

            return $table->make(true);
        }

        $groups = Product::where('is_group', 1)->whereIn('id', $pending_in_stock_products)->pluck('bar_code');
        $locations = $user_locations->pluck('full_name');

        if ($request->messages != null)
        {
            $messages = $request->messages;
            return view('admin.pendingStockIns.index', compact('messages', 'groups', 'locations'));
        }

        return view('admin.pendingStockIns.index', compact('groups', 'locations'));
    }

    public function show(Product $stockIn)
    {
        abort_if(Gate::denies('stock_in_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = $stockIn;
        $product->load('productProductMovements');

        return view('admin.pendingStockIns.show', compact('product'));
    }
}