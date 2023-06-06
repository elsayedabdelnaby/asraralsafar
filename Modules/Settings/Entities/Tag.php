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

class Tag extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Return the name of the tag dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function tagName(): Attribute
    {
        $tag = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('tag_name_' . $this->id . '_' .  App::getLocale(), function () use ($tag) {
                $tag = $tag->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $tag ? $tag->name : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(TagTranslation::class, 'tag_id');
    }
}
