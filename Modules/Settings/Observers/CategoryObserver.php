<?php

namespace Modules\Settings\Observers;

use App\Services\Cache\ClearCachedAttributes;
use Modules\Settings\Entities\Category;

class CategoryObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Category "updated" event.
     *
     * @param  \Modules\Categories\Entites\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        ClearCachedAttributes::clear($category->id, [
            'category_name',
            'category_description',
            'category_meta_title',
            'category_meta_description',
            'category_slug'
        ]);
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \Modules\Categories\Entites\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        ClearCachedAttributes::clear($category->id, [
            'category_name',
            'category_description',
            'category_meta_title',
            'category_meta_description',
            'category_slug'
        ]);
    }
}
