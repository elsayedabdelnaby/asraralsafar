<?php

namespace Modules\Website\Actions\Blogs;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Blog;
use Modules\Website\Entities\BlogTranslation;
use Modules\Website\Http\Requests\Blogs\StoreBlogRequest;

/**
 * handle create a blog
 */
class StoreBlogAction
{
    use FileUploadTrait;

    public function handle(StoreBlogRequest $request): Blog
    {
        $image = '';
        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/blogs');
        }

        $blog = new Blog();
        $blog->is_active = $request->is_active ? true : false;
        $blog->image = $image;
        $blog->save();

        $blog->categories()->attach($request->category_id, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'title' => $translation['title'],
                'slug' => $translation['slug'],
                'short_description' => $translation['short_description'],
                'description' => $translation['description'],
                'meta_title' => $translation['meta_title'],
                'meta_description' => $translation['meta_description'],
                'language_id' => $translation['language_id'],
                'blog_id' => $blog->id,
            ];

            BlogTranslation::create($translation_data);
        }

        return $blog;
    }
}
