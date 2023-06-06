<?php

namespace Modules\Settings\Actions\Categories;

use App\Services\DeleteFile;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\Category;
use Modules\Settings\Http\Requests\Categories\DeleteCategoryRequest;

/**
 * @purpose delete a category
 */
class DeleteCategoryAction
{
    /**
     * @param DeleteCategoryRequest $request
     * @return Boolean
     */
    public function handle(DeleteCategoryRequest $request): bool
    {
        $category = Category::findOrFail($request->id);
        //replace the category by this category
        DB::table('categorizables')->where('category_id', $category->id)->update([
            'category_id' => $request->replace_with
        ]);

        Category::where('parent_id', $category->id)->update(['parent_id' => $request->replace_with]);

        DeleteFile::delete($category->image, 'public', 'settings/categories');
        $category->translations()->delete();
        return $category->delete();
    }
}
