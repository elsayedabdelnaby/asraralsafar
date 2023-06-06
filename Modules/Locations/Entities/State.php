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

class State extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "states";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'is_active'];

    /**
     * Return the name of the state dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function stateName(): Attribute
    {
        $state = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('state_name_' . $this->id . '_' .  App::getLocale(), function () use ($state) {
                $state = $state->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $state ? $state->name : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(StateTranslation::class, 'state_id');
    }

    /**
     * get all related cities
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'state_id');
    }

    /**
     * Get country of the current state
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
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
