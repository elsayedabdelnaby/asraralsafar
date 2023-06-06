<?php

namespace Modules\Settings\Actions\Categories;

use App\Traits\FileUploadTrait;
use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\CategoryTranslation;
use Modules\Settings\Http\Requests\Categories\UpdateCategoryRequest;
use Modules\Settings\Http\Requests\SubCategories\UpdateSubCategoryRequest;

/**
 * @purpose edit a category
 */
class UpdateCategoryAction
{
    use FileUploadTrait;

    /**
     * @param UpdateCategoryRequest|UpdateSubCategoryRequest $request
     * @return Category
     */
    public function handle(UpdateCategoryRequest|UpdateSubCategoryRequest $request): Category
    {
        $category = Category::find($request->id);

        $image = $category->image ? $category->image : '';
        $mobile_image = $category->mobile_image ? $category->mobile_image : '';

        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'settings/categories');
        }

        if ($request->hasFile('mobile_image')) {
            $mobile_image = $this->verifyAndUpload($request->file('mobile_image'), $mobile_image, 'public', 'settings/categories');
        }

        $category->image = $image;
        $category->mobile_image = $mobile_image;

        if ($request->is_active_in_mobile) {
            $category->is_active_in_mobile = true;
            $category->display_order_in_mobile = $request->display_order_in_mobile ? $request->display_order_in_mobile : 0;
        }

        if ($request->is_active_in_website) {
            $category->is_active_in_website = true;
            $category->display_order_in_website = $request->display_order_in_website ? $request->display_order_in_website : 0;
        }

        if ($request->is_display_home_page_of_mobile) {
            $category->is_display_home_page_of_mobile = true;
            $category->display_order_in_home_page_of_mobile = $request->display_order_in_home_page_of_mobile ? $request->display_order_in_home_page_of_mobile : 0;
        }

        if ($request->is_display_home_page_of_website) {
            $category->is_display_home_page_of_website = true;
            $category->display_order_in_home_page_of_website = $request->display_order_in_home_page_of_website ? $request->display_order_in_home_page_of_website : 0;
        }

        $category->is_display_in_fav_category_of_mobile = $request->is_display_in_fav_category_of_mobile ? true : false;
        $category->is_display_in_fav_category_of_webite = $request->is_display_in_fav_category_of_webite ? true : false;

        $category->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            CategoryTranslation::updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                    'category_id' => $category->id
                ],
                [
                    'name' => $translation['name'],
                    'slug' => $translation['slug'],
                    'description' => $translation['description'],
                    'meta_title' => $translation['meta_title'],
                    'meta_description' => $translation['meta_description']
                ]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($category->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            CategoryTranslation::where([
                ['language_id', '=', $language_id],
                ['category_id', '=', $category->id]
            ])->delete();
        }

        $category->save();

        return $category;
    }
}
