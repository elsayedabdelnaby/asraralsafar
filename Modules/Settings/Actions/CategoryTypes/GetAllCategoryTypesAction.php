<?php

namespace Modules\Settings\Actions\CategoryTypes;

use Modules\Settings\Entities\CategoryType;

/**
 * @purpose get all category types
 */
class GetAllCategoryTypesAction
{
    public function handle()
    {
        return CategoryType::currentLanguageTranslation('category_types', 'category_type_translations', 'category_type_id');
    }
}
