<?php

namespace Modules\Package\Entities;

use Illuminate\Database\Eloquent\Model;

class AirLines extends Model
{

    protected $fillable = [];
    protected $appends = ['name'];

    public function translations()
    {
        return $this->hasMany(AirLinesTranslation::class);
    }

    public function getNameAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('air_lines_id', $this->id)->first()->name;
    }
}
