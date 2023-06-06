<?php

namespace Modules\Locations\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cities";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = ['state_id', 'is_active'];

    /**
     * Return the name of the city dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function cityName(): Attribute
    {
        $city = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('city_name_' . $this->id . '_' .  App::getLocale(), function () use ($city) {
                $city = $city->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $city ? $city->name : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CityTranslation::class, 'city_id');
    }

    /**
     * get the state of the city
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * log any activity on the current model
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty();
    }
}
