<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;
use Modules\Merchants\Entities\ProductTranslation;
use Modules\Merchants\Http\Requests\Product\StoreProductRequest;
use Modules\Merchants\Services\ProductService;

class StoreProductAction
{
    public function handle(StoreProductRequest $request): void
    {
        //Create Addition Product
        $product = Product::create((new ProductService())->prepareAttributes($request));
        $product->categories()->sync($request->get('category_id'));
        //create Addition Translations
        ProductTranslation::insert((new ProductService())->prepareTranslationsAttributes($request,$product->id));
    }
}
