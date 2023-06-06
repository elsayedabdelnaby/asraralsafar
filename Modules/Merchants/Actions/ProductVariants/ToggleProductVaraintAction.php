<?php

namespace Modules\Merchants\Actions\ProductVariants;

use Modules\Merchants\Entities\ProductVariant;
use Modules\Merchants\Http\Requests\ProductVariants\ToggleProductVariantRequest;

/**
 * @purpose
 * toggle the product attribute
 */
class ToggleProductVaraintAction
{
    /**
     * toggle the status of the city
     * @param ToggleProductVariantRequest $request
     * @return bool
     */
    public function handle(ToggleProductVariantRequest $request): bool
    {
        $productVariant = ProductVariant::find($request->get("id"));
        $productVariant->is_active = !$productVariant->is_active;
        return $productVariant->save();
    }
}
