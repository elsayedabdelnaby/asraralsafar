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

class PrivacyPolicy extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'privacy_policies';

    /**
     * Return the title of the privacy policy dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function privacyPolicyTitle(): Attribute
    {
        $privacy_policy = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('privacy_policy_title_' . $this->id . '_' .  App::getLocale(), function () use ($privacy_policy) {
                $privacy_policy = $privacy_policy->translation()->select('title')->where('language_id', getCurrentLanguage()->id)->first();
                return $privacy_policy ? $privacy_policy->title : null;
            }),
        );
    }

    /**
     * Return the description of the privacy policy dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function privacyPolicyDescription(): Attribute
    {
        $privacy_policy = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('privacy_policy_description_' . $this->id . '_' .  App::getLocale(), function () use ($privacy_policy) {
                $privacy_policy = $privacy_policy->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $privacy_policy ? $privacy_policy->description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(PrivacyPolicyTranslation::class, 'privacy_policy_id');
    }
}
