<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TakeoffStation extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'take_off_stations';

    protected $appends = ['name'];

    public function translations()
    {
        return $this->hasMany(TakeoffStationTranslation::class);
    }

    public function getNameAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('takeoff_station_id', $this->id)->first()->name;
    }
}
