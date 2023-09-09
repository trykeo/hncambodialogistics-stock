<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductMovementRequest;
use App\Http\Requests\StoreProductMovementRequest;
use App\Http\Requests\UpdateProductMovementRequest;
use App\Models\Location;
use App\Models\Product;
use App\Models\ProductMovement;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use Carbon\Carbon;

class ProductMovementController extends Controller
{
    //// CRUD METHOD

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_movement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_locations = Location::get();
        
        if (!auth()->user()->is_admin)
        {
            $user_locations = auth()->user()->locations;
        }

        if ($request->ajax()) {
            $locations = $user_locations->pluck('id');
            $query = ProductMovement::with(['product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by']);
            $query = $query->where(function($q) use ($locations) {
                $q->whereIn('product_movements.in_location_id', $locations)
                  ->orWhereIn('product_movements.out_location_id', $locations);
            });

            $query = $query->select(sprintf('%s.*', (new ProductMovement)->table));

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'product_movement_show';
                $editGate      = 'product_movement_edit';
                $deleteGate    = 'product_movement_delete';
                $crudRoutePart = 'product-movements';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->addColumn('product_bar_code', function ($row) use ($query) {
                return $row->product ? $row->product->bar_code : '';
            });

            $table->editColumn('remark', function ($row) {
                return $row->remark ? $row->remark : '';
            });
            $table->addColumn('in_location_code', function ($row) {
                return $row->in_location ? $row->in_location->code : '';
            });

            $table->addColumn('record_in_by_name', function ($row) {
                return $row->record_in_by ? $row->record_in_by->name : '';
            });

            $table->addColumn('out_location_code', function ($row) {
                return $row->out_location ? $row->out_location->code : '';
            });

            $table->addColumn('record_out_by_name', function ($row) {
                return $row->record_out_by ? $row->record_out_by->name : '';
            });

            $table->addColumn('record_finish_by_name', function ($row) {
                return $row->record_finish_by ? $row->record_finish_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by']);

            return $table->make(true);
        }

        $products  = Product::get();
        $locations = Location::get();
        $users     = User::get();

        return view('admin.productMovements.index', compact('products', 'locations', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_movement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('bar_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $in_locations = Location::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record_in_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $out_locations = Location::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record_out_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record_finish_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productMovements.create', compact('in_locations', 'out_locations', 'products', 'record_finish_bies', 'record_in_bies', 'record_out_bies'));
    }

    public function store(StoreProductMovementRequest $request)
    {
        $productMovement = ProductMovement::create($request->all());

        return redirect()->route('admin.product-movements.index');
    }

    public function edit(ProductMovement $productMovement)
    {
        abort_if(Gate::denies('product_movement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('bar_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $in_locations = Location::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record_in_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $out_locations = Location::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record_out_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record_finish_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productMovement->load('product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by');

        return view('admin.productMovements.edit', compact('in_locations', 'out_locations', 'productMovement', 'products', 'record_finish_bies', 'record_in_bies', 'record_out_bies'));
    }

    public function update(UpdateProductMovementRequest $request, ProductMovement $productMovement)
    {
        $productMovement->update($request->all());

        return redirect()->route('admin.product-movements.index');
    }

    public function show(ProductMovement $productMovement)
    {
        abort_if(Gate::denies('product_movement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productMovement->load('product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by');

        return view('admin.productMovements.show', compact('productMovement'));
    }

    public function destroy(ProductMovement $productMovement)
    {
        abort_if(Gate::denies('product_movement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productMovement->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductMovementRequest $request)
    {
        $productMovements = ProductMovement::find(request('ids'));

        foreach ($productMovements as $productMovement) {
            $productMovement->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
