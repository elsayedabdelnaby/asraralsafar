<?php

namespace Modules\Merchants\Actions\Product;

use Modules\Merchants\Entities\Product;
use Modules\Merchants\Http\Requests\Product\DeleteProductRequest;

class DeleteProductAction
{
    public function handle(DeleteProductRequest $request)
    {
         $product = Product::findOrFail($request->get('id'));
         $product->translations()->delete();
         $product->delete();
    }
}
