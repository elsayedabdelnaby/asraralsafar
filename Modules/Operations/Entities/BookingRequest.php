<?php

namespace Modules\Operations\Entities;

use Modules\Website\Entities\Service;
use Illuminate\Database\Eloquent\Model;
use Modules\Locations\Entities\City;
use Modules\Locations\Entities\Country;
use Modules\Locations\Entities\State;

class BookingRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'sex',
        'dob',
        'service_id',
        'service_date',
        'from_country_id',
        'from_state_id',
        'from_city_id',
        'to_country_id',
        'to_state_id',
        'to_city_id',
        'departure_date',
        'persons_number',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function fromCountry()
    {
        return $this->belongsTo(Country::class, 'from_country_id');
    }

    public function fromCity()
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function fromState()
    {
        return $this->belongsTo(State::class, 'from_state_id');
    }

    public function toCountry()
    {
        return $this->belongsTo(Country::class, 'to_country_id');
    }

    public function toCity()
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function toState()
    {
        return $this->belongsTo(State::class, 'to_state_id');
    }
}
