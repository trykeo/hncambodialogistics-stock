<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // SoftDeletes
    use HasFactory;

    public $table = 'products';

    private $date_format = 'Y-m-d H:i:s';
    private $display_format = 'D, d F, Y';

    protected $dates = [
        'deliver_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bar_code',
        'group',
        'deliver_at',
        'remark',
        'is_group',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function productProductMovements()
    {
        return $this->hasMany(ProductMovement::class, 'product_id', 'id');
    }

    // public function productProductMovements()
    // {
    //     return $this->product;
    //     ->latest();
    // }
    public function latestMovement()
    {
        return $this->hasOne(ProductMovement::class, 'product_id', 'id')->latestOfMany();
    }

    public function getDeliverAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat($this->date_format, $value)->format($this->display_format) : null;
    }

    public function setDeliverAtAttribute($value)
    {
        $input_format = config('panel.date_format') . ' ' . config('panel.time_format');
        $this->attributes['deliver_at'] = $value ? Carbon::createFromFormat($input_format, $value)->format($this->date_format) : null;
    }
}
