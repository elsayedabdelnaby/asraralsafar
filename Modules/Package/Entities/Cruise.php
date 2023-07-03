<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Website\Entities\CruiseFeature;

class Cruise extends Model
{
    protected $fillable = [
        'date',
        'start_from_price',
        'price'
    ];

    protected $appends = [
        'name',
        'description',
        'take_off_location',
    ];

    public function translations()
    {
        return $this->hasMany(CruiseTranslation::class);
    }

    public function features()
    {
        return $this->hasMany(CruiseFeature::class);
    }

    public function getNameAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('cruise_id', $this->id)->first()->name;
    }

    public function getDescriptionAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('cruise_id', $this->id)->first()->description;
    }

    public function getTakeOffLocationAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('cruise_id', $this->id)->first()->take_off_location;
    }
}
