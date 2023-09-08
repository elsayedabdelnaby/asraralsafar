<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Modules\Settings\Entities\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Modules\Settings\Entities\Category;
use Modules\Settings\Traits\WithCategory;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation, WithCategory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    /**
     * Interact with the social link's image url.
     *
     * @return string
     */
    public function getImageURLAttribute()
    {
        return $this->image ? asset(Storage::url('website/blogs/' . $this->image)) : null;
    }

    /**
     * Return the title of the blog dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function blogTitle(): Attribute
    {
        $blog = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('blog_title_' . $this->id . '_' .  App::getLocale(), function () use ($blog) {
                $blog = $blog->translations()->select('title')->where('language_id', getCurrentLanguage()->id)->first();
                return $blog ? $blog->title : null;
            }),
        );
    }

    /**
     * Return the slug of the blog dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function blogSlug(): Attribute
    {
        $blog = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('blog_slug_' . $this->id . '_' .  App::getLocale(), function () use ($blog) {
                $blog = $blog->translations()->select('slug')->where('language_id', getCurrentLanguage()->id)->first();
                return $blog ? $blog->slug : null;
            }),
        );
    }

    /**
     * Return the short description of the blog dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function blogShortDescription(): Attribute
    {
        $blog = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('blog_short_description_' . $this->id . '_' .  App::getLocale(), function () use ($blog) {
                $blog = $blog->translations()->select('short_description')->where('language_id', getCurrentLanguage()->id)->first();
                return $blog ? $blog->short_description : null;
            }),
        );
    }

    /**
     * Return the description of the blog dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function blogDescription(): Attribute
    {
        $blog = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('blog_description_' . $this->id . '_' .  App::getLocale(), function () use ($blog) {
                $blog = $blog->translations()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $blog ? $blog->description : null;
            }),
        );
    }

    /**
     * Return the description of the blog dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaTitle(): Attribute
    {
        $blog = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('blog_meta_title_' . $this->id . '_' .  App::getLocale(), function () use ($blog) {
                $blog = $blog->translations()->select('meta_title')->where('language_id', getCurrentLanguage()->id)->first();
                return $blog ? $blog->meta_title : null;
            }),
        );
    }

    /**
     * Return the description of the blog dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaDescription(): Attribute
    {
        $blog = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('blog_meta_description_' . $this->id . '_' .  App::getLocale(), function () use ($blog) {
                $blog = $blog->translations()->select('meta_description')->where('language_id', getCurrentLanguage()->id)->first();
                return $blog ? $blog->meta_description : null;
            }),
        );
    }

    /**
     * Return the category id of the blog.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function categoryId(): Attribute
    {
        return new Attribute(
            get: fn () => $this->categories()->first()?->id,
        );
    }

    /**
     * Return the category of the blog.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function category(): Attribute
    {
        return new Attribute(
            get: fn () => $this->categories()->first(),
        );
    }

    /**
     * Get the blog's category.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * get all related translations
     */
    public function translations(): HasMany
    {
        return $this->hasMany(BlogTranslation::class, 'blog_id');
    }

    /**
     * Get all basic comments of the blog.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
