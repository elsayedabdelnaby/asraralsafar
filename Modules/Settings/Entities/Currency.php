<?php

namespace Modules\Settings\Entities;

use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iso_code',
        'is_main',
        'symbol',
        'html_entity',
        'is_symbol_first',
        'is_active',
        'is_main'
    ];

    /**
     * Return the name of the currency dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function currencyName(): Attribute
    {
        $currency = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('currency_name_' . $this->id . '_' .  App::getLocale(), function () use ($currency) {
                $currency = $currency->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $currency ? $currency->name : null;
            }),
        );
    }


    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(CurrencyTranslation::class, 'currency_id');
    }
}
