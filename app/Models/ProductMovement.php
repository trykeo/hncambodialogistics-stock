<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMovement extends Model
{
    // SoftDeletes, 
    use HasFactory;

    public $table = 'product_movements';

    private $date_format = 'Y-m-d H:i:s';
    private $display_format = 'D, d F, Y H:i A';

    public const FINISH_STATUS = [
        'delivered'  => 'Delivered to customer',
        'picked_up'   => 'Picked up by customer',
        // 'completed'  => 'Completed',
    ];

    protected $dates = [
        'record_in_at',
        'record_out_at',
        'finish_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'product_id',
        'remark',
        'in_location_id',
        'record_in_at',
        'record_in_by_id',
        'out_location_id',
        'record_out_at',
        'record_out_by_id',
        'finish_at',
        'finish_status',
        'record_finish_by_id',
        'previous_record',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function in_location()
    {
        return $this->belongsTo(Location::class, 'in_location_id');
    }

    public function getRecordInAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat($this->date_format, $value)->format($this->display_format) : null;
    }

    public function setRecordInAtAttribute($value)
    {
        $input_format = config('panel.date_format') . ' ' . config('panel.time_format');
        $this->attributes['record_in_at'] = $value ? Carbon::createFromFormat($input_format, $value)->format($this->date_format) : null;
    }

    public function record_in_by()
    {
        return $this->belongsTo(User::class, 'record_in_by_id');
    }

    public function out_location()
    {
        return $this->belongsTo(Location::class, 'out_location_id');
    }

    public function getRecordOutAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat($this->date_format, $value)->format($this->display_format) : null;
    }

    public function setRecordOutAtAttribute($value)
    {
        $input_format = config('panel.date_format') . ' ' . config('panel.time_format');
        $this->attributes['record_out_at'] = $value ? Carbon::createFromFormat($input_format, $value)->format($this->date_format) : null;
    }

    public function record_out_by()
    {
        return $this->belongsTo(User::class, 'record_out_by_id');
    }

    public function getFinishAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat($this->date_format, $value)->format($this->display_format) : null;
    }

    public function setFinishAtAttribute($value)
    {
        $input_format = config('panel.date_format') . ' ' . config('panel.time_format');
        $this->attributes['finish_at'] = $value ? Carbon::createFromFormat($input_format, $value)->format($this->date_format) : null;
    }

    public function record_finish_by()
    {
        return $this->belongsTo(User::class, 'record_finish_by_id');
    }
}
