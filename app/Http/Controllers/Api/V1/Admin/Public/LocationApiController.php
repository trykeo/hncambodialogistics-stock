<?php

namespace App\Http\Controllers\Api\V1\Admin\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Location::query();

        if ($request->filled('code'))
        {
            $query->where('code', $request->code);
        }

        $locations = $query->get();

        return new LocationResource($locations);
    }

    public function show(Location $location)
    {
        return new LocationResource($location);
    }
}
