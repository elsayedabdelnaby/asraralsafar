<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TakeoffStationTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'take_off_station_translations';
    
}
