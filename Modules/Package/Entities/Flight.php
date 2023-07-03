<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{

    protected $fillable = [
        'image',
        'destination_slug',
        'arrival_time',
        'traveling_date',
        'price',
    ];

    protected $appends = [
        'company_name',
        'from_location',
        'to_location',
        'day',
        'price_currency',
    ];

    public function getCompanyNameAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('flight_id', $this->id)->first()->company_name;
    }

    public function getFromLocationAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('flight_id', $this->id)->first()->from_location;
    }

    public function getToLocationAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('flight_id', $this->id)->first()->to_location;
    }

    public function getDayAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('flight_id', $this->id)->first()->day;
    }

    public function getPriceCurrencyAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('flight_id', $this->id)->first()->price_currency;
    }


    public function translations()
    {
        return $this->hasMany(FlightTranslation::class);
    }
}
