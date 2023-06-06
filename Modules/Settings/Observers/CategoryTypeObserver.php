<?php

namespace Modules\Settings\Observers;

use App\Services\Cache\ClearCachedAttributes;
use Modules\Settings\Entities\CategoryType;

class CategoryTypeObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the CategoryType "updated" event.
     *
     * @param  \Modules\Categories\Entites\CategoryType  $category_type
     * @return void
     */
    public function updated(CategoryType $category_type)
    {
        ClearCachedAttributes::clear($category_type->id, ['category_type']);
    }

    /**
     * Handle the CategoryType "deleted" event.
     *
     * @param  \Modules\Categories\Entites\CategoryType  $page_notification
     * @return void
     */
    public function deleted(CategoryType $category_type)
    {
        ClearCachedAttributes::clear($category_type->id, ['category_type']);
    }
}
