<?php

namespace Modules\Website\Entities;

use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebsiteInformation extends Model
{
    use HasFactory, Userstamps;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_information';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name', 'main_logo_url', 'footer_logo_url'];

    /**
     * Interact with the Website's name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        $website_information = $this;
        return Cache::rememberForever('website_information_' . App::getLocale(), function () use ($website_information) {
            $website_information = $website_information->translations->where('language_id', getCurrentLanguage()->id)->first();
            return $website_information ? $website_information->name : null;
        });
    }

    /**
     * Interact with the website's main logo url.
     *
     * @return string
     */
    public function getMainLogoURLAttribute()
    {
        return $this->main_logo ? asset(Storage::url('website/' . $this->main_logo)) : null;
    }

    /**
     * Interact with the website's footer logo url.
     *
     * @return string
     */
    public function getFooterLogoURLAttribute()
    {
        return $this->footer_logo ? asset(Storage::url('website/' . $this->footer_logo)) : null;
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(WebsiteInformationTranslation::class, 'website_information_id');
    }
}
