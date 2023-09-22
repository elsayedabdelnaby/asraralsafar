<?php

namespace Modules\Website\Actions\Services;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Service;
use Modules\Website\Entities\ServiceTranslation;
use Modules\Website\Http\Requests\Services\UpdateServiceRequest;

/**
 * handle update a service condition
 */
class UpdateServiceAction
{
    use FileUploadTrait;

    public function handle(UpdateServiceRequest $request): Service
    {
        $service = Service::find($request->id);

        $image = $service->image ? $service->image : '';

        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/services');
        }

        $service->is_active = $request->is_active ? true : false;
        $service->type = $request->type;
        $service->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            ServiceTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'service_id' => $service->id
                ],
                [
                    'name' => $translation['title'],
                    'slug' => $translation['slug'],
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'],
                    'meta_description' => $translation['meta_description'],
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($service->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            ServiceTranslation::where([
                ['language_id', '=', $language_id],
                ['service_id', '=', $service->id]
            ])->delete();
        }

        return $service;
    }
}
