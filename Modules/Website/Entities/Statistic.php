<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statistic extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statistics';

    /**
     * Return the title of the statistic dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function statisticTitle(): Attribute
    {
        $statistic = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('statistic_title_' . $this->id . '_' .  App::getLocale(), function () use ($statistic) {
                $statistic = $statistic->translations()->select('title')->where('language_id', getCurrentLanguage()->id)->first();
                return $statistic ? $statistic->title : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(StatisticTranslation::class, 'statistic_id');
    }
}
