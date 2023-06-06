<?php

namespace Modules\Settings\Actions\Categories;

use Illuminate\Http\Request;
use Modules\Settings\Entities\Category;

/**
 * @purpose filter the categories or return all categories
 */
class FilterCategoriesAction
{
    /**
     * @param Request $request
     * @param Array $conditions
     */
    public function handle(Request $request, $conditions = null)
    {
        $categories = Category::currentLanguageTranslation('categories', 'category_translations', 'category_id')
            ->withType();

        if ($request->request->get('comman_categories') || request('comman_categories')) {
            $categories = $categories->whereNull('category_type_id');
        } elseif ($request->request->get('category_type_id') || request('category_type_id') || $request->get('category_type_id')) {
            $categories = $categories->where('categories.category_type_id', current(array_filter([request('category_type_id'), $request->request->get('category_type_id'),$request->get('category_type_id')])));
        }

        if ($request->request->get('category_id') || request('category_id') || $request->get('category_id')) {
            $categories = $categories->where('parent_id', current(array_filter([request('category_id'), $request->request->get('category_id'),$request->get('category_id')])));
        } elseif ($request->request->get('all') || request('all')) {
            $categories = $categories;
        } else {
            $categories = $categories->whereNull('parent_id');
        }

        if ($request->request->get('is_active_in_mobile') || request('is_active_in_mobile')) {
            $categories = $categories->where('is_active_in_mobile', 1);
        }

        if ($request->request->get('is_active_in_website') || request('is_active_in_website')) {
            $categories = $categories->where('is_active_in_website', 1);
        }

        if ($request->request->get('name')) {
            $name = $request->request->get('name');
            $categories = $categories->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });
        }

        if ($conditions) {
            $categories->where($conditions);
        }

        return $categories;
    }
}
