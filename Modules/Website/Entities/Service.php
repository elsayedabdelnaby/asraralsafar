<?php

namespace Modules\Website\Entities;

use App\Scopes\CurrentLanguageTranslation;
use App\Scopes\IsActive;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Wildside\Userstamps\Userstamps;

class Service extends Model
{
    use HasFactory, SoftDeletes, Userstamps, IsActive, CurrentLanguageTranslation;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

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
        return $this->image ? asset(Storage::url('website/services/' . $this->image)) : null;
    }

    /**
     * Return the name of the service dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function serviceName(): Attribute
    {
        $service = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('service_name_' . $this->id . '_' .  App::getLocale(), function () use ($service) {
                $service = $service->translation()->select('name')->where('language_id', getCurrentLanguage()->id)->first();
                return $service ? $service->name : null;
            }),
        );
    }


    /**
     * Return the description of the service dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function serviceDescription(): Attribute
    {
        $service = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('service_description_' . $this->id . '_' .  App::getLocale(), function () use ($service) {
                $service = $service->translation()->select('description')->where('language_id', getCurrentLanguage()->id)->first();
                return $service ? $service->description : null;
            }),
        );
    }

    /**
     * Return the description of the service dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaTitle(): Attribute
    {
        $service = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('service_meta_title_' . $this->id . '_' .  App::getLocale(), function () use ($service) {
                $service = $service->translation()->select('meta_title')->where('language_id', getCurrentLanguage()->id)->first();
                return $service ? $service->meta_title : null;
            }),
        );
    }

    /**
     * Return the description of the service dependent on the current app.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function metaDescription(): Attribute
    {
        $service = $this;
        return new Attribute(
            get: fn () => Cache::rememberForever('service_meta_description_' . $this->id . '_' .  App::getLocale(), function () use ($service) {
                $service = $service->translation()->select('meta_description')->where('language_id', getCurrentLanguage()->id)->first();
                return $service ? $service->meta_description : null;
            }),
        );
    }

    /**
     * get all related translations
     */
    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class, 'service_id');
    }
}
