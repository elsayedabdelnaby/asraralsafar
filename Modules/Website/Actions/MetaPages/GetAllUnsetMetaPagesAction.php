<?php

namespace Modules\Website\Actions\MetaPages;

use Modules\Website\Enums\PageName;
use Modules\Website\Entities\MetaPage;

/**
 * @purpose return all unset pages
 */
class GetAllUnsetMetaPagesAction
{
    /**
     * @return array
     */
    public static function get(): array
    {
        $pages = PageName::cases();
        $current_pages = MetaPage::pluck('page')->toArray();
        $unset_pages = [];
        foreach ($pages as $page) {
            if (!in_array($page->value, $current_pages)) {
                $unset_pages[] = $page;
            }
        }
        return $unset_pages;
    }
}
