<?php

namespace Modules\Settings\Actions\CategoryTypes;

use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Entities\CategoryTypeTranslation;
use Modules\Settings\Http\Requests\CategoryTypes\StoreCategoryTypeRequest;

/**
 * handle creation of category type
 */
class StoreCategoryTypeAction
{
    /**
     * @param StoreCategoryTypeRequest $request
     */
    public function handle(StoreCategoryTypeRequest $request): CategoryType
    {
        $category_type = new CategoryType();
        $category_type->is_active = $request->is_active ? true : false;
        $category_type->save();
        //working on translations
        foreach ($request->translations as $translation) {
            $translation_data = [
                'name' => $translation['name'],
                'language_id' => $translation['language_id'],
                'category_type_id' => $category_type->id,
            ];

            CategoryTypeTranslation::create($translation_data);
        }

        return $category_type;
    }
}
