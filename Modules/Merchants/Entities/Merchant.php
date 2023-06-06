<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\Entities\Category;
use App\Scopes\CurrentLanguageTranslation;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Merchant extends Model
{
    use HasFactory, SoftDeletes, IsActive, CurrentLanguageTranslation, Userstamps, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'merchants';
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logo_url'];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'logo',
        'is_active',
        'order_minimum_amount',
        'minimum_delivery_charges',
        'reviews_count',
        'average_delivery_time',
        'maximum_distance',
        'request_status',
        'hot_line',
        'has_branches',
        'working_status',
        'owner_id',
        'has_deliveries',
        'notes',
        'rush_time_status',
        'rush_time_additional_fees',
    ];

    /**
     * Return the name of the merchant dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function merchantName(): Attribute
    {
        $merchant = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('merchant_name_' . $this->id . '_' .  App::getLocale(), function () use ($merchant) {
                $merchant = $merchant->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $merchant ? $merchant->name : null;
            }),
        );
    }

    /**
     * Return the slug of the merchant dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function merchantSlug(): Attribute
    {
        $merchant = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('merchant_slug_' . $this->id . '_' .  App::getLocale(), function () use ($merchant) {
                $merchant = $merchant->translation()->select('slug')->where('language_id', getCurrentLanguage()->id)->first();
                return $merchant ? $merchant->slug : null;
            }),
        );
    }

    /**
     * Return the description of the merchant dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function merchantDescription(): Attribute
    {
        $merchant = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('merchant_description_' . $this->id . '_' .  App::getLocale(), function () use ($merchant) {
                $merchant = $merchant->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $merchant ? $merchant->description : null;
            }),
        );
    }

    /**
     * Return the meta_title of the merchant dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaTitle(): Attribute
    {
        $merchant = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('merchant_meta_title_' . $this->id . '_' .  App::getLocale(), function () use ($merchant) {
                $merchant = $merchant->translation()->select('meta_title')->where('language_id', getCurrentLanguage()->id)->first();
                return $merchant ? $merchant->meta_title : null;
            }),
        );
    }

    /**
     * Return the meta_description of the merchant dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaDescription(): Attribute
    {
        $merchant = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('merchant_meta_description_' . $this->id . '_' .  App::getLocale(), function () use ($merchant) {
                $merchant = $merchant->translation()->select('meta_description')->where('language_id', getCurrentLanguage()->id)->first();
                return $merchant ? $merchant->meta_description : null;
            }),
        );
    }

    /**
     * Return the rush_time_message of the merchant dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function rushTimeMessage(): Attribute
    {
        $merchant = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('merchant_rush_time_message_' . $this->id . '_' .  App::getLocale(), function () use ($merchant) {
                $merchant = $merchant->translation()->select('rush_time_message')->where('language_id', getCurrentLanguage()->id)->first();
                return $merchant ? $merchant->rush_time_message : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(MerchantTranslation::class, 'merchant_id');
    }

    /**
     * Interact with the logo url
     *
     * @return string
     */
    public function getLogoURLAttribute(): ?string
    {
        return $this->logo ? asset(Storage::url('merchants/merchants/' . $this->logo)) : null;
    }

    /**
     * Get All Related Branches
     */
    public function branches(): HasMany
    {
        return $this->hasMany(MerchantBranch::class, 'merchant_id');
    }

    /**
     * Get All Related Reviews
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(MerchantReview::class, 'merchant_id');
    }

    /**
     * get All Related Working Hours
     */
    public function workingHours(): HasMany
    {
        return $this->hasMany(WorkingHour::class, 'merchant_id');
    }

    /**
     * get All Related Socials
     */
    public function socials(): HasMany
    {
        return $this->hasMany(MerchantSocial::class, 'merchant_id');
    }

    /**
     * get All Related Category Items
     */
    public function categoryItems(): HasMany
    {
        return $this->hasMany(MerchantCategoryItem::class, 'merchant_id');
    }

    /**
     * get All Related Category Meal
     */
    public function categoryMeals(): HasMany
    {
        return $this->hasMany(MerchantMeal::class, 'merchant_id');
    }

    /**
     * get All Related Category Cuisine
     */
    public function categoryCuisines(): HasMany
    {
        return $this->hasMany(MerchantCuisine::class, 'merchant_id');
    }

    /**
     * get All Related Category Type
     */
    public function categoryTypes(): HasMany
    {
        return $this->hasMany(MerchantWorkingTypes::class, 'merchant_id');
    }

    /**
     * get all types/working fields of the merchant
     */
    public function workingAs(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, app(MerchantWorkingTypes::class)->getTable());
    }

    /**
     * get all product categories of the merchant
     */
    public function productCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, app(MerchantCategoryItem::class)->getTable());
    }

    /**
     * get all meals types/categories of the merchant
     */
    public function mealCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, app(MerchantMeal::class)->getTable());
    }

    /**
     * get all cusines types/categories
     */
    public function cuisineCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, app(MerchantCuisine::class)->getTable());
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
