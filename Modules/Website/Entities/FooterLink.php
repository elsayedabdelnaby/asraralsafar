<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class FooterLink extends Model
{
    use HasFactory, SoftDeletes, Userstamps, CurrentLanguageTranslation, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footer_links';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_url'];

    /**
     * Get the full url.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullUrlAttribute()
    {
        return $this->type == 'internal' ? env('APP_URL') . '/' . $this->url : $this->url;
    }

    /**
     * Return the name of the footer link dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function footerLinkname(): Attribute
    {
        $footer_link = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('footer_link_' . $this->id . '_' .  App::getLocale(), function () use ($footer_link) {
                $footer_link = $footer_link->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $footer_link ? $footer_link->name : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(FooterLinkTranslation::class, 'footer_link_id');
    }

    /**
     * return the section of the current link
     */
    public function section()
    {
        return $this->belongsTo(FooterSection::class, 'footer_section_id');
    }
}
