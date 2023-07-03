<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;

class ArrivalStation extends Model
{
    protected $fillable = [];
    protected $table = 'arrival_stations';

    protected $appends = ['name'];

    public function translations()
    {
        return $this->hasMany(ArrivalStationTranslation::class);
    }

    public function getNameAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('arrival_station_id', $this->id)->first()->name;
    }
}
