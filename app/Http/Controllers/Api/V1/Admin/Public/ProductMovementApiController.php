<?php

namespace App\Http\Controllers\Api\V1\Admin\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductMovementResource;
use App\Models\ProductMovement;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ProductMovementApiController extends Controller
{
    private function relationship()
    {
        return ['product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by'];
    }

    public function index(Request $request)
    {
        $query = ProductMovement::with($this->relationship());

        if ($request->filled('product_id')) {
            $query = $query->where('product_id', $request->product_id);
        }

        if ($request->filled('stock_in_date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->stock_in_date);
            $query = $query->whereDate('record_in_at', $date);
        }

        if ($request->filled('stock_out_date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->stock_out_date);
            $query = $query->whereDate('record_out_at', $date);
        }

        if ($request->filled('in_location_id')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->in_location_id);
            $query = $query->whereDate('in_location_id', $date);
        }

        if ($request->filled('out_location_id')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->out_location_id);
            $query = $query->whereDate('out_location_id', $date);
        }

        $product = $query->get();
        
        return new ProductMovementResource($product);
    }

    public function show(ProductMovement $productMovement)
    {
        return new ProductMovementResource($productMovement->load($this->relationship()));
    }
}
