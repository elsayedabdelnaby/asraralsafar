<?php

namespace Modules\Merchants\Actions\ProductAttributes;

use Modules\Merchants\Entities\ProductAttributeOption;
use Modules\Merchants\Http\Requests\ProductAttribtues\EditProductAttributeRequest;

class GetProductAttributeOptions
{
    public function handle(EditProductAttributeRequest $request)
    {
        return ProductAttributeOption::join('product_attribute_option_translations','product_attribute_option_translations.product_attribute_option_id','product_attribute_options.id')
                ->where('product_attribute_options.product_attribute_id',$request->get('id'))
                ->whereNULL('product_attribute_options.deleted_at')
                ->select([
                        'product_attribute_options.id',
                        'product_attribute_options.is_active',
                        'product_attribute_option_translations.name',
                        'product_attribute_option_translations.language_id',
                ])->get();
    }
}
