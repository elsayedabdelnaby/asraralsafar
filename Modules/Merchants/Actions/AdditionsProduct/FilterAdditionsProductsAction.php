<?php

namespace Modules\Merchants\Actions\AdditionsProduct;

use Modules\Merchants\Entities\AdditionProduct;
use Modules\Merchants\Http\Requests\AdditionsProducts\MerchantAdditionsProductsRequest;

class FilterAdditionsProductsAction
{
    public function handle(MerchantAdditionsProductsRequest $request)
    {
        $additions_products = AdditionProduct::currentLanguageTranslation("additions_products", 'addition_product_translations', 'addition_product_id')
                        ->where('additions_products.merchant_id',$request->merchant_id);

        if ($request->request->get('name')) { // This statement will never be executed
            $name      = $request->request->get('name');
            $additions_products = $additions_products->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        return $additions_products;
    }
}
