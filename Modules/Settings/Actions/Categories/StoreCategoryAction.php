<?php

namespace Modules\Settings\Actions\Categories;

use App\Traits\FileUploadTrait;
use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\CategoryTranslation;
use Modules\Settings\Http\Requests\Categories\StoreCategoryRequest;
use Modules\Settings\Http\Requests\SubCategories\StoreSubCategoryRequest;

/**
 * @purpose create a new category
 */
class StoreCategoryAction
{
    use FileUploadTrait;

    /**
     * @param StoreCategoryRequest|StoreSubCategoryRequest $request
     * @return Category
     */
    public function handle(StoreCategoryRequest|StoreSubCategoryRequest $request): Category
    {
        $image = '';
        $mobile_image = '';
        if ($request->hasFile('mobile_image')) {
            $mobile_image = $this->verifyAndUpload($request->file('mobile_image'), $mobile_image, 'public', 'settings/categories');
        }

        if ($request->hasFile('image')) {
            $image = $this->verifyAndUpload($request->file('image'), $image, 'public', 'settings/categories');
        }

        $category = new Category();

        $category->image = $image;
        $category->mobile_image = $mobile_image;
        $category->category_type_id = $request->category_type_id ? $request->category_type_id : null;
        $category->parent_id = $request->parent_id ? $request->parent_id : null;

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

        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'language_id' => $translation['language_id'],
                'category_id' => $category->id,
                'name' => $translation['name'],
                'slug' => $translation['slug'],
                'description' => $translation['description'],
                'meta_title' => $translation['meta_title'],
                'meta_description' => $translation['meta_description']
            ];

            CategoryTranslation::create($translation_data);
        }

        return $category;
    }
}
