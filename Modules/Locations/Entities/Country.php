<?php

namespace Modules\Locations\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Currency;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "countries";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active',
        'currency_id',
        'phone_code',
        'flag'
    ];

    protected $appends = ['display_name'];

    protected $lazyRelations = ['translations'];


    /**
     * Return the name of the country dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function countryName(): Attribute
    {
        $country = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('country_name_' . $this->id . '_' .  App::getLocale(), function () use ($country) {
                $country = $country->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $country ? $country->name : null;
            }),
        );
    }

    public function getDisplayNameAttribute()
    {
        return $this->translations->where('language_id', getCurrentLanguage()->id)->where('country_id', $this->id)->first()->name;
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CountryTranslation::class, 'country_id');
    }

    /**
     * get all related States
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class, 'country_id');
    }

    /**
     * get the currency belongs to the model
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
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
