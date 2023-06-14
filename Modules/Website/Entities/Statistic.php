<?php

namespace Modules\Website\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Statistic extends Model
{
    use CurrentLanguageTranslation;
    
    protected $fillable = [];

    public function translations()
    {
        return $this->hasMany(StatisticTranslation::class);
    }
}
