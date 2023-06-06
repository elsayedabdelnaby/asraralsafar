<?php

namespace Modules\Settings\Actions\CategoryTypes;

use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Http\Requests\CategoryTypes\ToggleCategoryTypeRequest;

/**
 * @purpose toggle the category type status
 */
class ToggleCategoryTypeAction
{
    /**
     * @param ToggleCategoryTypeRequest $request
     */
    public function handle(ToggleCategoryTypeRequest $request): bool
    {
        $category_type = CategoryType::find($request->id);
        $category_type->is_active = !$category_type->is_active;
        return $category_type->save();
    }
}
