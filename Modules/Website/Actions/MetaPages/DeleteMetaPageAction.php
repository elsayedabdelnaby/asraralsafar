<?php

namespace Modules\Website\Actions\MetaPages;

use App\Services\DeleteFile;
use Modules\Website\Entities\MetaPage;
use App\Services\Cache\ClearCachedAttributes;
use Modules\Website\Http\Requests\MetaPages\DeleteMetaPageRequest;

/**
 * @purpose delete a meta page
 */
class DeleteMetaPageAction
{
    /**
     * @param DeleteMetaPageRequest $request
     * @return bool
     */
    public function handle(DeleteMetaPageRequest $request): bool
    {
        $meta_page = MetaPage::findOrFail($request->id);
        //delete translations
        $meta_page->translations()->delete();
        //delete a meta image file
        DeleteFile::delete($meta_page->image, 'public', 'website/meta_pages');
        //clear cache
        ClearCachedAttributes::clear($meta_page->id, ['meta_page_title', 'meta_page_description']);
        return $meta_page->delete();
    }
}
