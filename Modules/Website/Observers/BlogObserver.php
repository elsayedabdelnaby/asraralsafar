<?php

namespace Modules\Website\Observers;

use Modules\Website\Entities\Blog;
use App\Services\Cache\ClearCachedAttributes;

class BlogObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;


    /**
     * Handle the Blog "updated" event.
     *
     * @param  \Modules\Website\Entites\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        ClearCachedAttributes::clear($blog->id, [
            'blog_title',
            'blog_slug',
            'blog_short_description',
            'blog_description',
            'blog_meta_title',
            'blog_meta_description'
        ]);
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \Modules\Website\Entites\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        ClearCachedAttributes::clear($blog->id, [
            'blog_title',
            'blog_slug',
            'blog_short_description',
            'blog_description',
            'blog_meta_title',
            'blog_meta_description'
        ]);
    }
}
