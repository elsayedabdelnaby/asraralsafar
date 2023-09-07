<?php

namespace Modules\Website\Entities;

use App\Traits\HasLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatisticTranslation extends Model
{
    use HasFactory, HasLanguage;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statistic_translations';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $fillable = ['title', 'language_id', 'statistic_id'];

    /**
     * return the related statistic
     */
    public function statistic()
    {
        return $this->belongsTo(Statistic::class, 'statistic_id');
    }
}
