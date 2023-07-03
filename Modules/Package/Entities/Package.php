<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Locations\Entities\Country;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Package\Entities\PackageTranslation;

class Package extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'image',
        'number_of_days',
        'number_of_clients',
        'number_of_meals',
        'traveling_date',
        'return_date',
        'meeting_time',
        'departure_time',
        'price_includes',
    ];

    protected $appends = [
        'title',
        'description',
        'traveling_location',
        'type_of_rooms'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function translations()
    {
        return $this->hasMany(PackageTranslation::class);
    }

    public function getTitleAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('package_id', $this->id)->first()->title;
    }

    public function getDescriptionAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('package_id', $this->id)->first()->description;
    }

    public function getTravelingLocationAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('package_id', $this->id)->first()->traveling_location;
    }

    public function getTypeOfRoomsAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('package_id', $this->id)->first()->type_of_rooms;
    }
}
