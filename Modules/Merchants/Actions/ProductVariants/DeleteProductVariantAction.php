<?php

namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Http\Requests\ProductVariants\DeleteProductVariantRequest;

class DeleteProductVariantAction
{
    public function handle(DeleteProductVariantRequest $request)
    {
         $productVariant = ProductVariant::findOrFail($request->get('id'));
         $productVariant->attributes()->delete();
         $productVariant->delete();
    }
}
