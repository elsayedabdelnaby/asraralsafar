<?php

namespace Modules\Settings\Actions\CategoryTypes;

use Modules\Settings\Entities\CategoryType;

/**
 * @purpose filter category types
 */
class FilterCategoryTypesAction
{
    public function handle(array $conditions = null)
    {
        $category_types = CategoryType::currentLanguageTranslation('category_types', 'category_type_translations', 'category_type_id');
        if ($conditions) {
            $category_types->where($conditions);
        }
        return $category_types;
    }
}
