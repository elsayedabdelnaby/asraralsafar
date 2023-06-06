<?php

namespace Modules\Settings\Actions\Categories;

use Modules\Settings\Entities\Category;
use Modules\Settings\Http\Requests\Categories\ToggleCategoryRequest;

/**
 * @purpose toggle the category
 */
class ToggleCategoryAction
{
    /**
     * @param ToggleCategoryRequest $request
     * @return Boolean
     */
    public function handle(ToggleCategoryRequest $request): bool
    {
        $category = Category::find($request->id);
        $name = $request->name;
        $category->$name = !$category->$name;
        return $category->save();
    }
}
