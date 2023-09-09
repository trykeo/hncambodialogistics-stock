<?php

namespace App\Http\Controllers\Api\V1\Admin\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Response;

use DB;
use Carbon\Carbon;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('is_delivered')) {
            $query = $request->is_delivered == 'yes' ? $query->whereNotNull('deliver_at') : $query->whereNull('deliver_at');
        }

        if ($request->filled('bar_code')) {
            $query = $query->where('bar_code', $request->bar_code);
        }

        if ($request->filled('create_date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->create_date);
            $query = $query->whereDate('created_at', $date);
        }

        if ($request->filled('deliver_date')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->deliver_date);
            $query = $query->whereDate('deliver_at', $date);
        }


        $product = $query->get();

        return new ProductResource($product);
    }

    public function group()
    {
        $groups = Product::where('is_group', 1)->get();
        $group_codes = $groups->pluck('bar_code')->toArray();
        $products = Product::whereIn('group', $group_codes)->get()->groupBy('group');

        foreach ($groups as $group) {
            $product_in_group = $products[$group->bar_code];
            if (isset($product_in_group) && count($product_in_group) > 0)
            {
                $group->products = $product_in_group;
            }
            else
            {
                $group->products = [];
            }
        }
        
        return new ProductResource($groups);
    }

    public function show(Product $product)
    {
        if ($product->is_group)
        {
            $product->products = Product::where('group', $product->bar_code)->get();
        }

        return new ProductResource($product);
    }
}
