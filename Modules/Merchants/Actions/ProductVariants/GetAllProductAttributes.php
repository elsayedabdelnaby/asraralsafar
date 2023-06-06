<?php
namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductAttribute;

class GetAllProductAttributes
{
    public function handle()
    {
       return ProductAttribute::currentLanguageTranslation('product_attributes', 'product_attribute_translations', 'product_attribute_id')->select([
           'product_attributes.id',
           'product_attributes.input_type',
           'product_attribute_translations.name'
       ])->get();
    }
}
