<?php

namespace Modules\Settings\Actions\CategoryTypes;

use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Http\Requests\CategoryTypes\DeleteCategoryTypeRequest;

/**
 * @purpose delete a category type
 */
class DeleteCategoryTypeAction
{
    /**
     * @param DeleteCategoryTypeRequest $request
     * @return bool
     */
    public function handle(DeleteCategoryTypeRequest $request): bool
    {
        //replace the category type by the new one
        Category::where('category_type_id', $request->id)->update([
            'category_type_id' => $request->replace_with,
        ]);

        $type = CategoryType::find($request->id);

        // delete all translations of this item
        $type->translations()->delete();

        return $type->delete();
    }
}
