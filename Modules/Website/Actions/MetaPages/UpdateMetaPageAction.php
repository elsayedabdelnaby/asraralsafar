<?php

namespace Modules\Website\Actions\MetaPages;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\MetaPage;
use App\Services\Cache\ClearCachedAttributes;
use Modules\Website\Entities\MetaPageTranslation;
use Modules\Website\Http\Requests\MetaPages\UpdateMetaPageRequest;

/**
 * handle update of meta page
 */
class UpdateMetaPageAction
{
    use FileUploadTrait;

    /**
     * @param UpdateMetaPageRequest $request
     */
    public function handle(UpdateMetaPageRequest $request): MetaPage
    {
        $meta_page = MetaPage::find($request->id);
        $image = $meta_page->image ? $meta_page->image : '';
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/meta_pages');
        }

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            MetaPageTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'meta_page_id' => $meta_page->id
                ],
                [
                    'title' => $translation['title'],
                    'description' => $translation['description']
                ]
            );
        }

        // delete not exists translations
        $deleted_languages = array_diff($meta_page->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            MetaPageTranslation::where([
                ['language_id', '=', $language_id],
                ['meta_page_id', '=', $meta_page->id]
            ])->delete();
        }

        $meta_page->page = $request->page;
        $meta_page->image = $image;
        $meta_page->save();

        //clear cache
        ClearCachedAttributes::clear($meta_page->id, ['meta_page_title', 'meta_page_description']);

        return $meta_page;
    }
}
