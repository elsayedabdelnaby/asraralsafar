<?php

namespace Modules\Merchants\Actions\ProductAttributes;

use Modules\Merchants\Entities\ProductAttribute;

class FilterProductAttributesAction
{
    public function handle()
    {
        return ProductAttribute::currentLanguageTranslation('product_attributes', 'product_attribute_translations', 'product_attribute_id');
    }
}
