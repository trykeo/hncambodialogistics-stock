<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
// use App\Http\Requests\StoreStockCompleteRequest;
// use App\Http\Requests\UpdateStockCompleteRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Location;
use App\Models\ProductMovement;
use Yajra\DataTables\Facades\DataTables;

class StockCompleteController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('stock_complete_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_locations = Location::get();
        
        if (!auth()->user()->is_admin)
        {
            $user_locations = auth()->user()->locations;
        }
        
        $completed_stocks = ProductMovement::whereIn('in_location_id', $user_locations->pluck('id'))
                                ->whereNull('record_out_at')
                                ->whereNotNull('finish_at')
                                ->pluck('product_id');

        if ($request->ajax()) {
            $query = Product::query()->select(sprintf('%s.*', (new Product)->table));

            // new filter for stock-in record
            $query = $query->whereNotNull('deliver_at')->whereIn('id', $completed_stocks)->get();

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'stock_complete_show';
                $editGate      = 'stock_complete_edit';
                $deleteGate    = 'stock_complete_delete';
                $crudRoutePart = 'stock-completes';

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
            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });
            $table->editColumn('finish_status', function ($row) {
                if ($row->latestMovement != null && $row->latestMovement->finish_status != null)
                {
                    return ProductMovement::FINISH_STATUS[$row->latestMovement->finish_status] ?? '';
                }

                return '';
            });
            $table->editColumn('stock_complete_location', function ($row) {
                if ($row->latestMovement != null && $row->latestMovement->in_location_id != null)
                {
                    return $row->latestMovement->in_location->full_name;
                }

                return '';
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

        $groups = Product::where('is_group', 1)->whereIn('id', $completed_stocks)->pluck('bar_code');
        $locations = $user_locations->pluck('full_name');

        if ($request->messages != null)
        {
            $messages = $request->messages;
            return view('admin.stockCompletes.index', compact('messages', 'groups', 'locations'));
        }

        return view('admin.stockCompletes.index', compact('groups', 'locations'));
    }

    public function show(Product $stockComplete)
    {
        abort_if(Gate::denies('stock_complete_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product = $stockComplete;
        $product->load('productProductMovements');

        return view('admin.stockCompletes.show', compact('product'));
    }

    public function create()
    {
        abort_if(Gate::denies('stock_complete_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $current_user = auth()->user();
        $out_locations = Location::get()->pluck('full_name', 'id');
        $user_locations = Location::get();
        
        if (!$current_user->is_admin)
        {
            $user_locations = $current_user->locations;
        }
        
        $user_location_ids = $user_locations->pluck('id');
        
        $completed_stocks = ProductMovement::whereIn('in_location_id', $user_location_ids)
                                ->whereNull('record_out_at')
                                ->whereNull('finish_at')
                                ->pluck('product_id');
        $products = Product::with('latestMovement')
                    ->whereNull('deliver_at')
                    ->where('is_group', 0)
                    ->whereIn('id', $completed_stocks)->get();

        $user_locations = $user_locations->pluck('full_name')->toArray();

        return view('admin.stockCompletes.create', compact('out_locations', 'user_locations', 'products'));
    }

    public function store(Request $request)
    {
        $products = explode(',', $request->products);
        $remark = $request->remark;
        $current_user_id = auth()->user()->id;
        $current_dt = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));

        $products = Product::with('latestMovement')->whereNull('deliver_at')->whereIn('id', $products)->get();

        foreach ($products as $product) {
            $productMovement = $product->latestMovement;

            if ($productMovement != null)
            {
                $productMovement->update([
                    'finish_at' => $current_dt,
                    'finish_status' => $request->finish_status,
                    'record_finish_by_id' => $current_user_id,
                    'remark' => $productMovement->remark ? $productMovement->remark."\n".$remark : $remark
                ]);
            }
            
            $product->update([
                'deliver_at' => $current_dt
            ]);
        }
        
        // $messages = [
        //     "success" => ["Recorded successfully"],
        //     "warning" => [],
        //     "danger"  => []
        // ];
        // , compact('messages')
        return redirect()->route('admin.stock-completes.index');
    }
    
    public function edit(Product $stockComplete)
    {
        abort_if(Gate::denies('stock_complete_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product = $stockComplete;

        if ($product->is_group)
        {
            // $product->products = Product::where('group', $product->bar_code)->pluck('bar_code', 'id');
            $products = Product::where('group', $product->bar_code)->pluck('bar_code', 'id')->toArray();
            $product->group_products = implode("\n", $products);
        }

        return view('admin.stockCompletes.edit', compact('product'));
    }

    public function update(Request $request, Product $stockComplete)
    {
        if ($stockComplete->is_group)
        {
            $group_products = preg_split("/\r\n|\n|\r/", $request->group_products);

            $remove_product = Product::where('group', $stockComplete->bar_code)
                                ->whereNotIn('bar_code', $group_products)->update([
                                    'group' => null
                                ]);

            Product::whereIn('bar_code', $group_products)->update([
                'group' => $request->bar_code
            ]);

            $stockComplete->update([
                'bar_code' => $request->bar_code,
                'remark'   => $request->remark ?? $stockComplete->remark
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
            
            $stockComplete->update($request->all());
        }

        // $messages = [
        //     "success" => [$stockComplete->bar_code.": updated successfully"]
        // ];
        // , compact('messages')

        return redirect()->route('admin.stock-completes.index');
    }

    private function remove_record_stock_complete(Product $product)
    {
        if ($product->is_group)
        {
            $group_products = Product::where('group', $product->bar_code)->get();

            foreach ($group_products as $child) {
                $child->update([
                    'deliver_at' => null
                ]);
                
                if ($child->latestMovement->finish_at != null)
                {
                    $child->latestMovement->update([
                        'finish_at'    => null,
                        'record_finish_by_id' => null
                    ]);
                }
            }
        }

        $product->update([
            'deliver_at' => null
        ]);

        $product->latestMovement->update([
            'finish_at'    => null,
            'record_finish_by_id' => null
        ]);

        return 'success';
    }

    public function destroy(Product $stockComplete)
    {
        abort_if(Gate::denies('stock_complete_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = $this->remove_record_stock_complete($stockComplete);

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
            $this->remove_record_stock_complete($product);
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}