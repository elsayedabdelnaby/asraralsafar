<?php

namespace Modules\Settings\Entities;

use App\Scopes\IsActive;
use Modules\Merchants\Entities\Coupon;
use Modules\Website\Entities\FAQ;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Get all the coupons that are assigned this category.
     */
    public function coupons(): MorphToMany
    {
        return $this->morphedByMany(Coupon::class, 'categorizable');
    }

    /**
     * Return the name of the category dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function categoryName(): Attribute
    {
        $category = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('category_name_' . $this->id . '_' .  App::getLocale(), function () use ($category) {
                $category = $category->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $category ? $category->name : null;
            }),
        );
    }

    /**
     * Return the slug of the category dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function categorySlug(): Attribute
    {
        $category = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('category_slug_' . $this->id . '_' .  App::getLocale(), function () use ($category) {
                $category = $category->translation()->select('slug')->where('language_id', getCurrentLanguage()->id)->first();
                return $category ? $category->slug : null;
            }),
        );
    }

    /**
     * Return the description of the category dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function categoryDescription(): Attribute
    {
        $category = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('category_description_' . $this->id . '_' .  App::getLocale(), function () use ($category) {
                $category = $category->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $category ? $category->description : null;
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
        return $this->image ? asset(Storage::url('settings/categories/' . $this->image)) : null;
    }

    /**
     * Interact with the social link's mobile image url.
     *
     * @return string
     */
    public function getMobileImageURLAttribute()
    {
        return $this->mobile_image ? asset(Storage::url('settings/categories/' . $this->mobile_image)) : null;
    }

    /**
     * Return the meta_title of the category dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaTitle(): Attribute
    {
        $category = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('category_meta_title_' . $this->id . '_' .  App::getLocale(), function () use ($category) {
                $category = $category->translation()->select('meta_title')->where('language_id', getCurrentLanguage()->id)->first();
                return $category ? $category->meta_title : null;
            }),
        );
    }

    /**
     * Return the meta_description of the category dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaDescription(): Attribute
    {
        $category = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('category_meta_description_' . $this->id . '_' .  App::getLocale(), function () use ($category) {
                $category = $category->translation()->select('meta_description')->where('language_id', getCurrentLanguage()->id)->first();
                return $category ? $category->meta_description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id');
    }

    /**
     * get the type of the category
     */
    public function type()
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
    }

    /**
     * get the parent category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * get all subcategories of the category
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * get all of the faqs that are assigned this category
     */
    public function faqs(): MorphToMany
    {
        return $this->morphedByMany(FAQ::class, 'categorizable');
    }

    /**
     * Scope a query to get the category type with translation if exist.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeWithType($query)
    {
        return $query->leftJoin('category_types', 'category_types.id', '=', 'categories.category_type_id')
            ->leftJoin('category_type_translations', 'category_type_translations.category_type_id', '=', 'category_types.id')
            ->where(function ($query) {
                $query->whereNull('categories.category_type_id')
                    ->orWhere('category_type_translations.language_id', getCurrentLanguage()->id);
            });
    }

    /**
     * Scope a query to get the parent categories only.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeParentsOnly($query)
    {
        return $query->whereNull('parent_id');
    }
}
