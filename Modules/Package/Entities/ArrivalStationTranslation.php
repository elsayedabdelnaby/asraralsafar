<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArrivalStationTranslation extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arrival_station_translations';
    
}
