<?php

namespace Modules\Website\Entities;

use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetaPage extends Model
{
    use HasFactory, SoftDeletes, Userstamps, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'meta_pages';

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
        return $this->image ? asset(Storage::url('website/meta_pages/' . $this->image)) : null;
    }

    /**
     * Return the title of the meta page dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaPageTitle(): Attribute
    {
        $meta_page = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('meta_page_title_' . $this->id . '_' .  App::getLocale(), function () use ($meta_page) {
                $meta_page = $meta_page->translation()->select('title')->where('language_id', getCurrentLanguage()->id)->first();
                return $meta_page ? $meta_page->title : null;
            }),
        );
    }

    /**
     * Return the description of the meta page dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaPageDescription(): Attribute
    {
        $meta_page = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('meta_page_description_' . $this->id . '_' .  App::getLocale(), function () use ($meta_page) {
                $meta_page = $meta_page->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $meta_page ? $meta_page->description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(MetaPageTranslation::class, 'meta_page_id');
    }
}
