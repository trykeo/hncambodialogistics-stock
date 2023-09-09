<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductMovement;

use Carbon\Carbon;
use App\Http\Resources\Admin\ProductResource;

class TrackingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tracking');
    }

    public function track($order_id)
    {
        $relation = ['latestMovement.out_location', 'latestMovement.in_location'];
        $until_date = Carbon::today()->add(1, 'day');
        $from_date = Carbon::today()->subMonth(); // last month

        $product = Product::with($relation)
                    ->where('bar_code', $order_id)
                    ->where(function ($query) use ($until_date, $from_date) {
                        $query->whereBetween('deliver_at', [$from_date, $until_date])
                        ->orWhereNull('deliver_at');
                    })->first();

        $group = null;
        $record = null;

        if ($product)
        {
            if (!$product->is_group) 
            {
                $group = Product::with($relation)->where('bar_code', $product->group)->first();
            }
            
            $record = ProductMovement::with(['in_location', 'out_location'])->where('product_id', $product->id)->get();
        }
        
        return response()->json([
            'group' => $group,
            'product' => $product,
            'record' => $record
        ]);
    }
}
