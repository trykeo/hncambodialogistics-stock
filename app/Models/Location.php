<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Location extends Model implements HasMedia
{
    // SoftDeletes
    use InteractsWithMedia, HasFactory;

    public $table = 'locations';

    public const COUNTRY = [
        'cambodia'  => 'Cambodia',
        'thailand'   => 'Thailand',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'country',
        'address',
        'remark',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    public function inLocationProductMovements()
    {
        return $this->hasMany(ProductMovement::class, 'in_location_id', 'id');
    }

    public function locationUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
