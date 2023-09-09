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

class ThStockInController extends Controller
{
    public function index(Request $request)
    {
        // abort_if(Gate::denies('th_stock_in_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_locations = Location::where('country', 'thailand')->get();
        
        if (!auth()->user()->is_admin)
        {
            $user_locations = auth()->user()->locations;
        }
        
        $in_stock_products = ProductMovement::whereIn('in_location_id', $user_locations->pluck('id'))
                                ->whereNull('record_out_at')
                                ->whereNull('finish_at')
                                ->pluck('product_id');

        if ($request->ajax()) {
            $query = Product::query()->select(sprintf('%s.*', (new Product)->table));

            // new filter for stock-in record
            $query = $query->with('latestMovement')->whereIn('id', $in_stock_products)->get();

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'stock_in_show';
                $editGate      = 'stock_in_edit';
                $deleteGate    = 'stock_in_delete';
                $crudRoutePart = 'th-stock-ins';

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
            $table->editColumn('stock_in_at', function ($row) {
                if ($row->latestMovement != null && $row->latestMovement->record_in_at != null)
                {
                    return $row->latestMovement->record_in_at;
                }

                return '';
            });
            $table->editColumn('stock_in_location', function ($row) {
                if ($row->latestMovement != null && $row->latestMovement->in_location_id != null)
                {
                    return $row->latestMovement->in_location->full_name;
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

        $groups = Product::where('is_group', 1)->whereIn('id', $in_stock_products)->pluck('bar_code');
        $locations = $user_locations->pluck('full_name');

        if ($request->messages != null)
        {
            $messages = $request->messages;
            return view('admin.thStockIns.index', compact('messages', 'groups', 'locations'));
        }

        return view('admin.thStockIns.index', compact('groups', 'locations'));
    }

    public function create()
    {
        // abort_if(Gate::denies('stock_in_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $current_user = auth()->user();
        $in_locations = Location::where('country', 'thailand')->get()->pluck('full_name', 'id');

        if (!$current_user->is_admin)
        {
            $in_locations = $current_user->locations->pluck('full_name', 'id');
        }

        return view('admin.thStockIns.create', compact('in_locations'));
    }

    public function store(Request $request)
    {
        // $success_msg = [];
        // $warning_msg = [];
        // $error_msg = [];
        $current_dt = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $remark = $request->remark;
        $in_location_id = $request->in_location_id;
        $current_user_id = auth()->user()->id;
        $bar_codes = preg_split("/\r\n|\n|\r/", $request->bar_code);

        // start process for each bar_code
        foreach ($bar_codes as $bar_code) {
            $product = Product::where('bar_code', $bar_code)->first();
            $previous_record_id = null;
            $children_product_ids = [];

            // create product if not existed
            if ($product == null)
            {
                $product = Product::create([
                    'bar_code' => $bar_code,
                    'remark'   => $remark
                ]);

                ProductMovement::create([
                    'product_id'      => $product->id,
                    'remark'          => $remark,
                    'in_location_id'  => $in_location_id,
                    'record_in_at'    => $current_dt,
                    'record_in_by_id' => $current_user_id
                ]);
            }
            else
            {
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

                // check for previous record where out_location == location_id 
                // $existed_record = ProductMovement::where('product_id', $product_id)
                //                     ->whereNull('finish_at')
                //                     ->whereNull('out_location_id')
                //                     ->where('in_location_id', $in_location_id)
                //                     ->first();

                // if ($existed_record != null)
                // {
                //     $msg = "Product still has status stock in location ".$existed_record->in_location->name;
                //     array_push($error_msg, $product->bar_code.": ".$msg);
                //     continue;
                // }
                
                $previous_record = ProductMovement::where('product_id', $product_id)
                                    ->whereNull('finish_at')
                                    ->where('out_location_id', $in_location_id)
                                    ->first();

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
                    // $msg = "Stock in location ".$duplicate_record->in_location->name." already recorded in id ".$duplicate_record->id;
                    // array_push($warning_msg, $product->bar_code.": ".$msg);
                    continue;
                }
                else
                {
                    ProductMovement::create([
                        'product_id'      => $product_id,
                        'remark'          => $remark,
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
                                    'remark'          => $remark,
                                    'in_location_id'  => $in_location_id,
                                    'record_in_at'    => $current_dt,
                                    'record_in_by_id' => $current_user_id,
                                    'previous_record' => $child_movement->id
                                ]);
                            }
                        }
                    }
                }
            }
            
            // array_push($success_msg, $product->bar_code.": Created successfully");
        }

        // $messages = [
        //     "success" => $success_msg,
        //     "warning" => $warning_msg,
        //     "danger"  => $error_msg
        // ];
        // , compact('messages')
        return redirect()->route('admin.th-stock-ins.index');
    }

    public function show(Product $stockIn)
    {
        // abort_if(Gate::denies('stock_in_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = $stockIn;
        $product->load('productProductMovements');

        return view('admin.thStockIns.show', compact('product'));
    }

    public function edit(Product $stockIn)
    {
        // abort_if(Gate::denies('stock_in_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product = $stockIn;

        if ($product->is_group)
        {
            $products = Product::where('group', $product->bar_code)->pluck('bar_code', 'id')->toArray();
            $product->group_products = implode("\n", $products);
        }

        return view('admin.thStockIns.edit', compact('product'));
    }

    public function update(Request $request, Product $stockIn)
    {
        if ($stockIn->is_group)
        {
            $group_products = preg_split("/\r\n|\n|\r/", $request->group_products);

            $remove_product = Product::where('group', $stockIn->bar_code)
                                ->whereNotIn('bar_code', $group_products)->update([
                                    'group' => null
                                ]);

            Product::whereIn('bar_code', $group_products)->update([
                'group' => $request->bar_code
            ]);

            $stockIn->update([
                'bar_code' => $request->bar_code,
                'remark'   => $request->remark ?? $stockIn->remark
            ]);
        }
        else
        {
            if ($request->filled('group') && 
                    Product::where('bar_code', $request->group)
                    ->where('is_group', 1)
                    ->whereNull('deliver_at')
                    ->first() == null)
            {
                $request['group'] = null;
            }
            
            $stockIn->update($request->all());
        }

        // $messages = [
        //     "success" => [$stockIn->bar_code.": updated successfully"]
        // ];

        // , compact('messages')

        return redirect()->route('admin.th-stock-ins.index');
    }

    private function remove_record_stock_in(Product $product)
    {
        $latest_record = $product->latestMovement;

        if ($product->is_group)
        {
            Product::where('group', $product->bar_code)->update([
                'group' => null
            ]);
        }

        if ($latest_record != null)
        {
            $previous_record = ($latest_record != null && $latest_record->previous_record != null && $latest_record->previous_record != '') ? 
            ProductMovement::where('id', $latest_record->previous_record)->first() : null;

            // check if record already stock-out
            if ($latest_record->record_out_at != null)
            {
                return "product already stock-out";
            }
            else
            {
                // remove record
                $latest_record->delete();
            }

            if ($previous_record != null)
            {
                $previous_record->update([
                    'finish_at' => null,
                    'record_finish_by_id' => null
                ]);
            }
            else
            {
                $product->delete();
            }
        }
        else
        {
            $product->delete();
        }

        return 'success';
    }

    public function destroy(Product $stockIn)
    {
        // abort_if(Gate::denies('stock_in_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = $this->remove_record_stock_in($stockIn);

        // if ($status != 'success')
        // {
        //     // return error
        //     return back(compact('status'));
        // }

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        $products = Product::find(request('ids'));

        foreach ($products as $product) {
            // $product->delete();
            $this->remove_record_stock_in($product);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    // Product Group
    public function grouping()
    {
        $current_user = auth()->user();
        $user_locations = Location::where('country', 'thailand')->get();
        
        if (!$current_user->is_admin)
        {
            $user_locations = $current_user->locations;
        }
        
        $user_location_ids = $user_locations->pluck('id');
        
        $in_stock_products = ProductMovement::whereIn('in_location_id', $user_location_ids)
                                ->whereNull('finish_at')
                                ->pluck('product_id');

        $products = Product::with('latestMovement')
                        ->whereIn('id', $in_stock_products)
                        ->whereNull('deliver_at')
                        ->whereNull('group')
                        ->where('is_group', 0)
                        ->get();
                        
        $user_locations = $user_locations->pluck('full_name')->toArray();

        return view('admin.thStockIns.group', compact('user_locations', 'products'));
    }

    public function storeGrouping(Request $request)
    {
        $group_code = $request->group;
        $remark = $request->remark;
        $current_dt = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        // $products = explode(',', $request->products);
        $bar_codes = preg_split("/\r\n|\n|\r/", $request->bar_code);
        $productQuery = Product::whereIn('bar_code', $bar_codes);

        if ($productQuery->count() == 0)
        {
            $messages = [
                "danger"  => ["No product available for grouping"]
            ];

            return redirect()->route('admin.th-stock-ins.index', compact('messages'));
        }

        $productIds = $productQuery->pluck('id')->toArray();

        $movement_record = ProductMovement::whereIn('product_id', $productIds)
                                ->whereNull('finish_at')
                                ->first();

        if ($movement_record == null)
        {
            $messages = [
                "danger"  => ["No product stock in yet"]
            ];

            return redirect()->route('admin.th-stock-ins.index', compact('messages'));
        }

        $group = Product::create([
            'bar_code' => $group_code,
            'remark' => $remark,
            'is_group' => true,
        ]);

        $productQuery->update(['group' => $group_code]);
        
        ProductMovement::create([
            'remark' => $remark,
            'record_in_at' => $current_dt,
            'product_id' => $group->id,
            'in_location_id' => $movement_record->in_location_id,
            'record_in_by_id' => auth()->user()->id
        ]);

        // $messages = [
        //     "success" => ["Recorded successfully"],
        //     "warning" => [],
        //     "danger"  => []
        // ];
        // , compact('messages')
        return redirect()->route('admin.th-stock-ins.index');
    }
}