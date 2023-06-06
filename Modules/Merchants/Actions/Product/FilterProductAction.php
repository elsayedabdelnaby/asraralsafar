<?php

namespace Modules\Merchants\Actions\Product;

use Illuminate\Http\Request;
use Modules\Merchants\Entities\Product;

class FilterProductAction
{
    public function handle(Request $request)
    {
        $products = Product::currentLanguageTranslation("products", 'product_translations', 'product_id')
                        ->where('products.merchant_id',$request->merchant_id);

        if ($request->request->get('name')) { // This statement will never be executed
            $name      = $request->request->get('name');
            $products = $products->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        return $products;
    }
}
