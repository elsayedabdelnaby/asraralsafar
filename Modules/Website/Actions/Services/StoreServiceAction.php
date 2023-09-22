<?php

namespace Modules\Website\Actions\Services;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Service;
use Modules\Website\Entities\ServiceTranslation;
use Modules\Website\Http\Requests\Services\StoreServiceRequest;

/**
 * handle create a service
 */
class StoreServiceAction
{
    use FileUploadTrait;

    public function handle(StoreServiceRequest $request): Service
    {
        $image = '';
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/services');
        }

        $service = new Service();
        $service->is_active = $request->is_active ? true : false;
        $service->display_order = $request->display_order ? $request->display_order : 0;
        $service->image = $image;
        $service->type = $request->type;
        $service->save();

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['title'],
                'description' => $translation['description'],
                'slug' => $translation['slug'],
                'meta_title' => $translation['meta_title'],
                'meta_description' => $translation['meta_description'],
                'language_id' => $translation['language_id'],
                'service_id' => $service->id,
            ];

            ServiceTranslation::create($translation_data);
        }

        return $service;
    }
}
