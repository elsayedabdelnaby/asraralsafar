<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TermCondition extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'terms_conditions';

    /**
     * Return the title of the term condition dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function termConditionTitle(): Attribute
    {
        $term_condition = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('term_condition_title_' . $this->id . '_' .  App::getLocale(), function () use ($term_condition) {
                $term_condition = $term_condition->translations()->select('title')->where('language_id', getCurrentLanguage()->id)->first();
                return $term_condition ? $term_condition->title : null;
            }),
        );
    }

    /**
     * Return the description of the term condition dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function termConditionDescription(): Attribute
    {
        $term_condition = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('term_condition_description_' . $this->id . '_' .  App::getLocale(), function () use ($term_condition) {
                $term_condition = $term_condition->translations()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $term_condition ? $term_condition->description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(TermConditionTranslation::class, 'term_condition_id');
    }
}
