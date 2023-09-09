<?php

namespace App\Http\Requests;

use App\Models\ProductMovement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductMovementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_movement_create');
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                'integer',
            ],
            'in_location_id' => [
                'required',
                'integer',
            ],
            'record_in_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'record_in_by_id' => [
                'required',
                'integer',
            ],
            'record_out_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'finish_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
