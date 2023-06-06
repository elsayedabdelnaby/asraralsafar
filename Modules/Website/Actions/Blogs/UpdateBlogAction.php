<?php

namespace Modules\Website\Actions\Blogs;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Blog;
use Modules\Website\Entities\BlogTranslation;
use Modules\Website\Http\Requests\Blogs\UpdateBlogRequest;

/**
 * handle update a blog condition
 */
class UpdateBlogAction
{
    use FileUploadTrait;

    public function handle(UpdateBlogRequest $request): Blog
    {
        $blog = Blog::find($request->id);

        $image = $blog->image ? $blog->image : '';

        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'website/blogs');
        }

        $blog->is_active = $request->is_active ? true : false;
        $blog->save();

        $blog->categories()->sync($request->category_id, [
            'updated_at' => now()
        ]);

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            BlogTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'blog_id' => $blog->id
                ],
                [
                    'title' => $translation['title'],
                    'slug' => $translation['slug'],
                    'short_description' => $translation['short_description'],
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'],
                    'meta_description' => $translation['meta_description'],
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($blog->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            BlogTranslation::where([
                ['language_id', '=', $language_id],
                ['blog_id', '=', $blog->id]
            ])->delete();
        }

        return $blog;
    }
}
