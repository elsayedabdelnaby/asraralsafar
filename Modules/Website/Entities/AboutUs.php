<?php

namespace Modules\Website\Entities;

use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory, SoftDeletes, Userstamps, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about_us';

    /**
     * Return the title of the term condition dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function aboutusTitle(): Attribute
    {
        $aboutUs = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('about_us_title_' . $this->id . '_' .  App::getLocale(), function () use ($aboutUs) {
                $aboutUs = $aboutUs->translation()->select('title')->where('language_id', getCurrentLanguage()->id)->first();
                return $aboutUs ? $aboutUs->title : null;
            }),
        );
    }

    /**
     * Return the description of the term condition dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function aboutusDescription(): Attribute
    {
        $aboutUs = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('about_us_description_' . $this->id . '_' .  App::getLocale(), function () use ($aboutUs) {
                $aboutUs = $aboutUs->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $aboutUs ? $aboutUs->description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(AboutUsTranslation::class, 'about_us_id');
    }
}
