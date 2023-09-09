<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
// use App\Http\Requests\StoreStockOutRequest;
// use App\Http\Requests\UpdateStockOutRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Location;
use App\Models\ProductMovement;
use Yajra\DataTables\Facades\DataTables;

use App\Models\UserAlert;

class StockOutController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('stock_out_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_locations = Location::get();
        
        if (!auth()->user()->is_admin)
        {
            $user_locations = auth()->user()->locations;
        }
        
        $in_stock_products = ProductMovement::whereIn('in_location_id', $user_locations->pluck('id'))
                                ->whereNotNull('record_out_at')
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
                $viewGate      = 'stock_out_show';
                $editGate      = 'stock_out_edit';
                $deleteGate    = 'stock_out_delete';
                $crudRoutePart = 'stock-outs';

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

            $table->rawColumns(['actions', 'placeholder', 'type']);

            return $table->make(true);
        }

        $groups = Product::where('is_group', 1)->whereIn('id', $in_stock_products)->pluck('bar_code');
        $locations = $user_locations->pluck('full_name');

        if ($request->messages != null)
        {
            $messages = $request->messages;
            return view('admin.stockOuts.index', compact('messages', 'groups', 'locations'));
        }

        return view('admin.stockOuts.index', compact('groups', 'locations'));
    }

    public function show(Product $stockOut)
    {
        abort_if(Gate::denies('stock_out_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = $stockOut;
        $product->load('productProductMovements');

        return view('admin.stockOuts.show', compact('product'));
    }

    public function create()
    {
        abort_if(Gate::denies('stock_out_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $current_user = auth()->user();
        $out_locations = Location::get()->pluck('full_name', 'id');
        $user_locations = Location::get();
        
        if (!$current_user->is_admin)
        {
            $user_locations = $current_user->locations;
        }
        
        $user_location_ids = $user_locations->pluck('id');
        
        $in_stock_products = ProductMovement::whereIn('in_location_id', $user_location_ids)
                                ->whereNull('record_out_at')
                                ->whereNull('finish_at')
                                ->pluck('product_id');

        $products = Product::with('latestMovement')
                    ->whereNull('deliver_at')
                    ->where(function ($q) {
                        $q->whereNull('group')->orWhere('is_group', 1);
                    })
                    ->whereIn('id', $in_stock_products)->get();

        $user_locations = $user_locations->pluck('full_name')->toArray();
        $default_out_location = Location::whereNotIn('id', $user_location_ids)->first()->full_name ?? ($user_locations[1] ?? '');
        
        return view('admin.stockOuts.create', compact('out_locations', 'user_locations', 'products', 'default_out_location'));
    }

    public function store(Request $request)
    {
        $out_location_id = $request->out_location_id;
        // $product_ids = explode(',', $request->products);
        $bar_codes = preg_split("/\r\n|\n|\r/", $request->bar_code);
        $product_ids = Product::whereIn('bar_code', $bar_codes)->pluck('id')->toArray();

        $remark = $request->remark;
        
        // $success_msg = [];
        // $warning_msg = [];
        // $error_msg = [];
        $current_dt = Carbon::now()->format('Y-m-d H:i:s');
        $current_user_id = auth()->user()->id;

        // add notification
        // $from_locations = [];
        // $out_location = Location::where('id', $out_location_id)->first();
        // $movements = ProductMovement::whereIn('product_id', $product_ids)
        //             ->where('in_location_id', '!=', $out_location_id)
        //             ->whereNull('out_location_id')
        //             ->whereNull('finish_at')
        //             ->get();

        // foreach ($movements as $movement) 
        // {
        //     if (!isset($from_locations[$movement->in_location->name])) 
        //     {
        //         $from_locations[$movement->in_location->name] = [];
        //     }

        //     array_push($from_locations[$movement->in_location->name], $movement->product->bar_code);
        // }

        // if (count($from_locations) > 0)
        // {
        //     $out_location_name = $out_location != null ? $out_location->name : null;
        //     foreach ($from_locations as $from_location => $products) {
        //         // $product_msg = join(', ', $products);
        //         $alert_msg = 'Stock out from '.$from_location.' to '.$out_location_name;
                
        //         $userAlert = UserAlert::create([
        //             'alter_title' => 'Pending stock in',
        //             'alert_text'  => $alert_msg,
        //         ]);

        //         $userAlert->users()->sync($out_location->locationUsers->pluck('id') ?? []);
        //     }
        // }
        // 
        
        // $existed_record = ProductMovement::whereIn('product_id', $product_ids)
        //                     ->where('out_location_id', $out_location_id)
        //                     ->whereNull('finish_at')
        //                     ->get();

        // if (count($existed_record) > 0)
        // {
        //     $location = $existed_record[0]->out_location->name;
        //     $product_ids = $existed_record->pluck('product_id')->toArray();
        //     $bar_codes = Product::whereIn('id', $product_ids)->pluck('bar_code');

        //     foreach ($bar_codes as $bar_code) {
        //         array_push($error_msg, $bar_code.": Already sent out to ".$location);
        //     }
        // }
        // dd($current_dt);
        // 02-05-2023 08:51:38
        // dd(config('panel.date_format') . ' ' . config('panel.time_format'));

        $movements = ProductMovement::whereIn('product_id', $product_ids)
                    ->where('in_location_id', '!=', $out_location_id)
                    ->whereNull('out_location_id')
                    ->whereNull('finish_at')
                    ->update([
                        'out_location_id'  => $out_location_id,
                        'record_out_at'    => $current_dt,
                        'record_out_by_id' => $current_user_id
                    ]);

        $product_groups = Product::whereIn('id', $product_ids)->where('is_group', 1)->pluck('bar_code')->toArray();

        if (count($product_groups) > 0)
        {
            $child_product_ids = Product::whereIn('group', $product_groups)->pluck('id')->toArray();

            if (count($child_product_ids) > 0)
            {
                ProductMovement::whereIn('product_id', $child_product_ids)
                    ->where('in_location_id', '!=', $out_location_id)
                    ->whereNull('out_location_id')
                    ->whereNull('finish_at')
                    ->update([
                        'out_location_id'  => $out_location_id,
                        'record_out_at'    => $current_dt,
                        'record_out_by_id' => $current_user_id
                    ]);
            }
        }

        // array_push($success_msg, "Recorded successfully");

        // $messages = [
        //     "success" => $success_msg,
        //     "warning" => $warning_msg,
        //     "danger"  => $error_msg
        // ];
        // , compact('messages')
        return redirect()->route('admin.stock-outs.index');
    }

    public function edit(Product $stockOut)
    {
        abort_if(Gate::denies('stock_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product = $stockOut;

        if ($product->is_group)
        {
            // $product->products = Product::where('group', $product->bar_code)->pluck('bar_code', 'id');
            $products = Product::where('group', $product->bar_code)->pluck('bar_code', 'id')->toArray();
            $product->group_products = implode("\n", $products);
        }

        return view('admin.stockOuts.edit', compact('product'));
    }

    public function update(Request $request, Product $stockOut)
    {
        if ($stockOut->is_group)
        {
            $group_products = preg_split("/\r\n|\n|\r/", $request->group_products);

            $remove_product = Product::where('group', $stockOut->bar_code)
                                ->whereNotIn('bar_code', $group_products)->update([
                                    'group' => null
                                ]);

            Product::whereIn('bar_code', $group_products)->update([
                'group' => $request->bar_code
            ]);

            $stockOut->update([
                'bar_code' => $request->bar_code,
                'remark'   => $request->remark ?? $stockOut->remark
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
            
            $stockOut->update($request->all());
        }

        // $messages = [
        //     "success" => [$stockOut->bar_code.": updated successfully"]
        // ];
        // , compact('messages')
        return redirect()->route('admin.stock-outs.index');
    }

    private function remove_record_stock_out(Product $product)
    {
        if ($product->is_group)
        {
            $group_products = Product::where('group', $product->bar_code)->get();

            foreach ($group_products as $child) {
                $child_latest_record = $child->latestMovement;

                if ($child_latest_record->finish_at == null && $child_latest_record->record_out_at != null)
                {
                    $child_latest_record->update([
                        'record_out_at'    => null,
                        'record_out_by_id' => null,
                        'out_location_id'  => null
                    ]);
                }
            }
        }

        $latest_record = $product->latestMovement;

        if ($latest_record->finish_at != null)
        {
            return 'record transaction already finished';
        }

        $latest_record->update([
            'record_out_at'    => null,
            'record_out_by_id' => null,
            'out_location_id'  => null
        ]);

        return 'success';
    }

    public function destroy(Product $stockOut)
    {
        abort_if(Gate::denies('stock_out_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = $this->remove_record_stock_out($stockOut);

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
            $this->remove_record_stock_out($product);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}