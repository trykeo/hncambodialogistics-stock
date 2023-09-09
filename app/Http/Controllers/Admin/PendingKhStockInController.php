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

class PendingKhStockInController extends Controller
{

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
                $crudRoutePart = 'pending-kh-stock-ins';

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
            return view('admin.pendingKhStockIns.index', compact('messages', 'groups', 'locations'));
        }

        return view('admin.pendingKhStockIns.index', compact('groups', 'locations'));
    }

    public function show(Product $stockIn)
    {
        abort_if(Gate::denies('stock_in_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = $stockIn;
        $product->load('productProductMovements');

        return view('admin.pendingKhStockIns.show', compact('product'));
    }
    
    public function massStockIn(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));
        
        $current_dt = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $current_user_id = auth()->user()->id;
        
        // start process for each bar_code
        foreach ($products as $product) {
            $previous_record_id = null;
            $children_product_ids = [];
            
            $product_id = $product->id;
            
            if ($product->is_group)
            {
                $children_product_ids = Product::where('group', $product->bar_code)->pluck('id')->toArray();
            }

            if ($product->deliver_at != null)
            {
                // array_push($warning_msg, $product->bar_code.": Already delivered");
                continue;
            }
            
            $previous_record = $product->latestMovement;
            $in_location_id = $previous_record->out_location_id;

            if ($previous_record != null)
            {
                if ($previous_record->finish_at == null)
                {
                    $previous_record->update([
                        'finish_at' => $current_dt,
                        'record_finish_by_id' => $current_user_id
                    ]);
                }
                
                $previous_record_id = $previous_record->id.'';
            }

            $duplicate_record = ProductMovement::where('product_id', $product_id)
                                ->whereNull('finish_at')
                                ->where('in_location_id', $in_location_id)
                                ->first();

            if ($duplicate_record != null)
            {
                continue;
            }
            else
            {
                ProductMovement::create([
                    'product_id'      => $product_id,
                    'in_location_id'  => $in_location_id,
                    'record_in_at'    => $current_dt,
                    'record_in_by_id' => $current_user_id,
                    'previous_record' => $previous_record_id
                ]);

                if (count($children_product_ids) > 0)
                {
                    $children_movements = ProductMovement::whereIn('product_id', $children_product_ids) 
                                            ->whereNull('finish_at')
                                            ->where('out_location_id', $in_location_id)
                                            ->get();

                    foreach ($children_movements as $child_movement) {
                        $child_movement->update([
                            'finish_at' => $current_dt,
                            'record_finish_by_id' => $current_user_id
                        ]);

                        $duplicate_record = ProductMovement::where('product_id', $child_movement->product_id)
                                            ->whereNull('finish_at')
                                            ->where('in_location_id', $in_location_id)
                                            ->first();

                        if ($duplicate_record == null)
                        {
                            ProductMovement::create([
                                'product_id'      => $child_movement->product_id,
                                'in_location_id'  => $in_location_id,
                                'record_in_at'    => $current_dt,
                                'record_in_by_id' => $current_user_id,
                                'previous_record' => $child_movement->id
                            ]);
                        }
                    }
                }
            }
            
            
            // array_push($success_msg, $product->bar_code.": Created successfully");
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}