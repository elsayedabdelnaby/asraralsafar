<?php

namespace Modules\Website\Actions\MetaPages;

use Illuminate\Support\Facades\DB;
use Modules\Website\Entities\MetaPage;
use Illuminate\Support\Facades\Storage;

/**
 * handle get all meta pages
 */
class GetAllMetaPagesAction
{
    public function handle()
    {
        return MetaPage::currentLanguageTranslation('meta_pages', 'meta_page_translations', 'meta_page_id')
            ->select(
                'meta_pages.id',
                'page',
                'title',
                'description',
                'image',
                DB::raw('CONCAT("' . asset(Storage::url('website/meta_pages')) . '/' . '", image) as image_url'),
                DB::raw('null as Actions')
            )->get();
    }
}
