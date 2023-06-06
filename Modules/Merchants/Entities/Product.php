<?php

namespace Modules\Merchants\Entities;

use App\Scopes\IsActive;
use Modules\Settings\Entities\CategoryType;
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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Userstamps, SoftDeletes, IsActive, CurrentLanguageTranslation, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "products";

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'is_active',
        'image',
        'merchant_id',
        'category_type_id',
        'accept_additions',
        'price',
        'discount_price',
    ];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $appends = ['image_url'];

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

    /**
     * Return the name of the product dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function productName(): Attribute
    {
        $product = $this;
        return new Attribute(
            get: fn() => Cache::rememberForever('product_name_' . $this->id . '_' . App::getLocale(), function () use ($product) {
                $product = $product->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $product ? $product->name : null;
            }),
        );
    }

    /**
     * Return the slug of the product dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function productSlug(): Attribute
    {
        $product = $this;
        return new Attribute(
            get: fn() => Cache::rememberForever('product_slug_' . $this->id . '_' . App::getLocale(), function () use ($product) {
                $product = $product->translation()->select('slug')->where('language_id', getCurrentLanguage()->id)->first();
                return $product ? $product->slug : null;
            }),
        );
    }

    /**
     * Return the description of the product dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function productDescription(): Attribute
    {
        $product = $this;
        return new Attribute(
            get: fn() => Cache::rememberForever('product_description_' . $this->id . '_' . App::getLocale(), function () use ($product) {
                $product = $product->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $product ? $product->description : null;
            }),
        );
    }

    /**
     * Interact with the social link's image url.
     *
     * @return string
     */
    public function getImageURLAttribute()
    {
        return $this->image ? asset(Storage::url('merchants/products/' . $this->image)) : null;
    }

    /**
     * Return the meta_title of the product dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaTitle(): Attribute
    {
        $product = $this;
        return new Attribute(
            get: fn() => Cache::rememberForever('product_meta_title_' . $this->id . '_' . App::getLocale(), function () use ($product) {
                $product = $product->translation()->select('meta_title')->where('language_id', getCurrentLanguage()->id)->first();
                return $product ? $product->meta_title : null;
            }),
        );
    }

    /**
     * Return the meta_description of the product dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaDescription(): Attribute
    {
        $product = $this;
        return new Attribute(
            get: fn() => Cache::rememberForever('product_meta_description_' . $this->id . '_' . App::getLocale(), function () use ($product) {
                $product = $product->translation()->select('meta_description')->where('language_id', getCurrentLanguage()->id)->first();
                return $product ? $product->meta_description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id');
    }

    /**
     * Get merchant of the current product
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    /**
     * Get category type of the current product
     */
    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_type_id');
    }

    /**
     * Get the blog's category.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Get all product variants
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
