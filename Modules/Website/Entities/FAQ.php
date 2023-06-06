<?php

namespace Modules\Website\Entities;

use App\Scopes\IsActive;
use Illuminate\Support\Facades\App;
use Wildside\Userstamps\Userstamps;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Category;
use Modules\Settings\Traits\WithCategory;
use App\Scopes\CurrentLanguageTranslation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQ extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation, WithCategory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faqs';

    /**
     * Return the question of the faq dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function faqQuestion(): Attribute
    {
        $faq = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('faq_question_' . $this->id . '_' .  App::getLocale(), function () use ($faq) {
                $faq = $faq->translation()->select('question')->where('language_id', getCurrentLanguage()->id)->first();
                return $faq ? $faq->question : null;
            }),
        );
    }

    /**
     * Return the answer of the faq dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function faqAnswer(): Attribute
    {
        $faq = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('faq_answer_' . $this->id . '_' .  App::getLocale(), function () use ($faq) {
                $faq = $faq->translation()->select('answer')->where('language_id', getCurrentLanguage()->id)->first();
                return $faq ? $faq->answer : null;
            }),
        );
    }

    /**
     * Return the category id of the faq.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function categoryId(): Attribute
    {
        return new Attribute(
            get: fn () => $this->categories()->first()->id,
        );
    }

    /**
     * Return the category of the faq.
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
     * Get the faq's category.
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
        return $this->hasMany(FAQTranslation::class, 'faq_id');
    }
}
