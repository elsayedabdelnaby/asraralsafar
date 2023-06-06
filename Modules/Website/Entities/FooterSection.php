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

class FooterSection extends Model
{
    use HasFactory, SoftDeletes, Userstamps, CurrentLanguageTranslation, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footer_sections';

    /**
     * Return the name of the footer section dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function footerSectionName(): Attribute
    {
        $footer_section = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('footer_section_' . $this->id . '_' .  App::getLocale(), function () use ($footer_section) {
                $footer_section = $footer_section->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $footer_section ? $footer_section->name : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(FooterSectionTranslation::class, 'footer_section_id');
    }

    /**
     * get all footer links
     */
    public function footerlinks()
    {
        return $this->hasMany(FooterLink::class, 'footer_section_id');
    }
}
