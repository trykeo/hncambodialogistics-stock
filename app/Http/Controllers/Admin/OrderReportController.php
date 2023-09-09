<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Product;
use App\Models\Location;
use App\Models\ProductMovement;

use Carbon\Carbon;

class OrderReportController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('order_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report_by = $request->report_by ?? 'today';

        $today = Carbon::today();

        $records = [];

        if ($report_by == 'today')
        {
            $records = ProductMovement::whereDate('finish_at', $today)
                        ->orWhereDate('record_in_at', $today)
                        ->orWhereDate('record_out_at', $today)
                        ->get();
        }
        elseif ($report_by == 'this_month')
        {
            $records = ProductMovement::whereYear('created_at', $today->year)
                        ->where(function ($q) use ($today) {
                            $q->whereMonth('finish_at', $today->month)
                            ->orWhereMonth('record_in_at', $today->month)
                            ->orWhereMonth('record_out_at', $today->month);
                        })->get();
        }
        elseif ($report_by == 'this_year')
        {
            $records = ProductMovement::whereYear('created_at', $today->year)->get();
        }

        // $products = Product::all();
        // $groups = Product::where('is_group', 1)->pluck('bar_code');

        $locations = Location::get();
        
        if (!auth()->user()->is_admin)
        {
            $locations = auth()->user()->locations;
        }

        $locations = $locations->pluck('full_name');

        return view('admin.orderReports.index', compact('records', 'locations', 'report_by'));
    }

    // public function show(OrderReport $orderReport)
    // {
    //     abort_if(Gate::denies('order_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return view('admin.orderReports.show', compact('orderReport'));
    // }
}