<?php

namespace Modules\Website\Actions\MetaPages;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\MetaPage;
use Modules\Website\Entities\MetaPageTranslation;
use Modules\Website\Http\Requests\MetaPages\StoreMetaPageRequest;

/**
 * handle creation of meta page
 */
class StoreMetaPageAction
{
    use FileUploadTrait;

    /**
     * @param StoreMetaPageRequest $request
     * @return MetaPage
     */
    public function handle(StoreMetaPageRequest $request): MetaPage
    {
        $image = '';
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/meta_pages');
        }

        $meta_page = new MetaPage();
        $meta_page->page = $request->page;
        $meta_page->image = $image;
        $meta_page->save();

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'title' => $translation['title'],
                'description' => $translation['description']
            ];

            // insert translation if not exist
            $translation_data['language_id'] = $translation['language_id'];
            $translation_data['meta_page_id'] = $meta_page->id;

            MetaPageTranslation::create($translation_data);
        }

        return $meta_page;
    }
}
