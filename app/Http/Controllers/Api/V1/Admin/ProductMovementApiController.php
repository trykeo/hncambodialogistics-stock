<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductMovementRequest;
use App\Http\Requests\UpdateProductMovementRequest;
use App\Http\Resources\Admin\ProductMovementResource;
use App\Models\ProductMovement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductMovementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_movement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductMovementResource(ProductMovement::with(['product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by'])->get());
    }

    public function store(StoreProductMovementRequest $request)
    {
        $productMovement = ProductMovement::create($request->all());

        return (new ProductMovementResource($productMovement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductMovement $productMovement)
    {
        abort_if(Gate::denies('product_movement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductMovementResource($productMovement->load(['product', 'in_location', 'record_in_by', 'out_location', 'record_out_by', 'record_finish_by']));
    }

    public function update(UpdateProductMovementRequest $request, ProductMovement $productMovement)
    {
        $productMovement->update($request->all());

        return (new ProductMovementResource($productMovement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductMovement $productMovement)
    {
        abort_if(Gate::denies('product_movement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productMovement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
