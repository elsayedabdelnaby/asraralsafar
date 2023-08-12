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

class Testimonail extends Model
{
    use HasFactory, SoftDeletes, Userstamps, CurrentLanguageTranslation, IsActive;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimonails';

    /**
     * Return the client name of the testimonail dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function testimonailClientName(): Attribute
    {
        $testimonail = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('testimonail_client_name_' . $this->id . '_' .  App::getLocale(), function () use ($testimonail) {
                $testimonail = $testimonail->translation()->select('client_name')->where('language_id', getCurrentLanguage()->id)->first();
                return $testimonail ? $testimonail->title : null;
            }),
        );
    }

    /**
     * Return the description of the testimonail dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function testimonailTestimonail(): Attribute
    {
        $testimonail = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('testimonail_testimonail_' . $this->id . '_' .  App::getLocale(), function () use ($testimonail) {
                $testimonail = $testimonail->translation()->select('testimonail')->where('language_id', getCurrentLanguage()->id)->first();
                return $testimonail ? $testimonail->testimonail : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(TestimonailTranslation::class, 'testimonail_id');
    }
}
