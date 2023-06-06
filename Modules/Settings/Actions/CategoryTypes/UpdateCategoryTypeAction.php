<?php

namespace Modules\Settings\Actions\CategoryTypes;

use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Entities\CategoryTypeTranslation;
use Modules\Settings\Http\Requests\CategoryTypes\UpdateCategoryTypeRequest;

/**
 * @purpose update a type of category
 */
class UpdateCategoryTypeAction
{
    /**
     * @param UpdateCategoryTypeRequest $request
     * @return CategoryType
     */
    public function handle(UpdateCategoryTypeRequest $request): CategoryType
    {
        $category_type = CategoryType::find($request->id);
        $category_type->is_active = $request->is_active ? true : false;
        $category_type->save();

        // update translations
        $languages_ids = [];
        foreach ($request->translations as $translation) {
            $languages_ids[] = $translation['language_id'];
            CategoryTypeTranslation::updateOrCreate(
                ['language_id' => $translation['language_id'], 'category_type_id' => $category_type->id],
                ['name' => $translation['name']]
            );
        }
        // delete not exists translations
        $deleted_languages = array_diff($category_type->translations->pluck('language_id')->toArray(), $languages_ids);
        foreach ($deleted_languages as $language_id) {
            CategoryTypeTranslation::where([
                ['language_id', '=', $language_id],
                ['category_type_id', '=', $category_type->id]
            ])->delete();
        }

        return $category_type;
    }
}
