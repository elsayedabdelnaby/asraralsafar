<?php
namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductAttributeOption;
use Modules\Merchants\Http\Requests\ProductAttribtues\CheckGetAttributeOptionsRequest;

class GetAttributeOptionsAction
{
    public function handle(CheckGetAttributeOptionsRequest $request)
    {
       return ProductAttributeOption::currentLanguageTranslation('product_attribute_options', 'product_attribute_option_translations', 'product_attribute_option_id')->select([
           'product_attribute_options.id',
           'product_attribute_option_translations.name'
       ])
       ->where('product_attribute_id',$request->get('id'))
       ->where('product_attribute_options.is_active',1)
       ->get();
    }
}
